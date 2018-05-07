<?php

namespace App\Console\Commands;

use App\Models\OrderHeader;
use App\Services\ApiRequest;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class getswiftDeliveriesUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:getswift-deliveries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'syncing all the customers order deliveries into getswift ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user)
        {
            Auth::loginUsingId($user->id);

            $order_headers = OrderHeader::query()->where(function ($q){
                $q->whereNull('getswift_status')->orWhere('getswift_status' , OrderHeader::DELIVERY_NEW);
            })->orderByDesc('id')->get();

            foreach ($order_headers as $order_header)
            {
                $url = config('getswift.base_url').config('getswift.deliveries');

                $request_data = $this->mappingGetswiftFeilds($order_header);

                list($response , $httpcode) = ApiRequest::curlRequest($url , $request_data);

                dd($response);
                echo "response code ". $httpcode ." ";
                if ($httpcode != 200 && isset($response->message))
                {
                    Log::notice('getswift order sync: '.$response->message);
                    continue;
                }

                $order_header->getswift_status = OrderHeader::GETSWIFT_STATUS_POSTED;

                $order_header->save();
            }

            Auth::logout();
        }

    }

    private function mappingGetswiftFeilds($order_header)
    {

        $getswift_key = auth()->user()->getMerchantGetswiftKey();

        $order_store_info = $order_header->storeInfo;

        $items = [];
        foreach ($order_header->orderDetails as $orderDetail)
        {
            $item = [];
            $item['quantity'] =  $orderDetail->qty_selling_units;
            $item['sku'] =  trim($orderDetail->sku_number);
            $item['description'] =  $orderDetail->description;
            $item['price'] =  $orderDetail->cust_price;

            $items[] = $item;
        }

        $data = array (
            'apiKey' => $getswift_key,
            'booking' =>
                array (
                    'reference' => $order_header->order_number,
                    'deliveryInstructions' => '', // need to add this deliveryInstruction in orderDetail model in orderheader table
                    'items' => $items,
                    'pickupTime' => \Carbon\Carbon::parse($order_header->creation_date)->format('Y-m-d\Th:m:s.000000+00:00'),
                    'pickupDetail' =>
                        array (
                            'name' => $order_store_info->long_name,
                            'phone' => $order_store_info->number,
                            'email' => auth()->user()->email,
                            'description' => $order_store_info->long_name,
                            'address' => $order_store_info->full_address,

                        ),
                    'dropoffWindow' =>
                        array (
                            'earliestTime' => \Carbon\Carbon::parse($order_header->delivery_date)->format('Y-m-d\Th:m:s.000000+00:00'),
                            'latestTime' => \Carbon\Carbon::parse($order_header->delivery_date)->format('Y-m-d\Th:m:s.000000+00:00'),
                        ),
                    'dropoffDetail' =>
                        array (
                            'name' => $order_header->ship_to_name,
                            'phone' => $order_header->phone_no,
                            'email' => $order_header->ship_to_email_address,
//                            'description' => '',
                            'address' => $order_header->full_address,
                        ),


                        ),
                    );

        return $data;
    }
}
