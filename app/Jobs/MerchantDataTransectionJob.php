<?php

namespace App\Jobs;

use App\Models\MerchantSetting;
use App\Models\OrderDetail;
use App\Models\OrderHeader;
use App\Models\Remote\ROrderHeader;
use App\Models\Remote\RStoreInfo;
use App\Models\StoreInformation;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class MerchantDataTransectionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $merchant_settings;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $merchant)
    {
        $this->user = $merchant;

        $this->merchant_settings = MerchantSetting::withoutGlobalScopes()->where('user_id' , $merchant->id)
            ->where('slug' , MerchantSetting::MERCHANT_ORDER_CODE_SLUG)->first();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if (is_null($this->merchant_settings))
            throw new \Exception($this->user->email.' User not selected the order Code');

        if (is_null($this->user->pos_wan_address))
            throw new \Exception('This User not setup his remote database wan_address');


        if (!test_remote_connection($this->user->pos_wan_address , $this->user))
            throw new \Exception('system not able to connect this '.$this->user->email.' merchant remote database');

        setRemoteConnection( $this->user->pos_wan_address , $this->user );

        $field_name = $this->merchant_settings->key;
        $field_value = $this->merchant_settings->value;

        ROrderHeader::where($field_name , $field_value)
            ->chunk(100, function ($remoteOHs) {
                $remoteOHs->map( function ($data){
                    $data['user_id'] = $this->user->id;
                    return $data;
                });
            foreach ($remoteOHs as $remoteOH) {

                //order headers
                $this->user->orderHeaders()
                    ->withoutGlobalScope('user_id')
                    ->updateOrCreate([
                        'order_number' => $remoteOH->order_number,
                        'user_id' => $this->user->id
                    ],
                    $remoteOH->getAttributes());

                echo $remoteOH->order_number."\n";
                //order details
                foreach ($remoteOH->orderDetails as $orderDetail)
                {
                    $this->user->orderDetails()
                        ->updateOrCreate([
                            'user_id' => $this->user->id,
                            'transaction_number' => $orderDetail->transaction_number,
                            'ref_no' => $orderDetail->ref_no
                        ],
                        $orderDetail->toArray() );
                }

                // store information
                if ($st = $remoteOH->orderStore)
                {
                    $this->user->storeInformation()
                        ->updateOrCreate([
                            'store_number' => $st->store_number,
                            'user_id' => $this->user->id
                        ],
                        $st->getAttributes());
                }

            }
        });

    }
}
