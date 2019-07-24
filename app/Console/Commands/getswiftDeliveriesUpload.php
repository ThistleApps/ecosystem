<?php

namespace App\Console\Commands;

use App\Models\OrderHeader;
use App\Services\ApiRequest;
use App\User;
use Carbon\Carbon;
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
        Log::info('Attempting to post deliveries');
        $users = User::all();

        foreach ($users as $user)
        {
            Auth::loginUsingId($user->id);

            $getswift_key = auth()->user()->getMerchantGetswiftKey();
            //var_dump($getswift_key);

            if (is_null($getswift_key))
            {
                Log::info("getswift order sync: this merchant ".auth()->user()->email. " does not have the getswift key");
                continue;
            }
            //Log::info("Log before order header 1");

            $order_headers = OrderHeader::query()->where(function ($q){
                $q->whereNull('getswift_status')->orWhere('getswift_status' , OrderHeader::DELIVERY_NEW);
            })->orderByDesc('id')->get();

            //Log::info("Log after order header 2");

            foreach ($order_headers as $order_header)
            {
                //var_dump($order_header);
                //Log::info("inside loop 1");

                /*if (\Carbon\Carbon::parse($order_header->creation_date)->lessThan(Carbon::now()->addMonth()))
                    continue;*/

                $url = config('getswift.base_url').config('getswift.deliveries');

                $request_data = $this->mappingGetswiftFeilds($order_header , $getswift_key);

                list($response , $httpcode) = ApiRequest::curlRequest($url , $request_data);

                //Log::info(base64_encode($response));

                echo "response code ". $httpcode ." ";
                if ($httpcode != 200 && isset($response->message))
                {
                    Log::error('user:'.auth()->user()->email. 'getswift order sync: order_number: '.$order_header->order_number.' -----message:---- '.$response->message);
                    continue;
                }

                Log::info(base64_encode($response));

                //test code
               /* if ($httpcode = 200)
                {
                    $order_header->getswift_status = OrderHeader::DELIVERY_ADDED;
                    Log::info('user:'.auth()->user()->email. 'getswift order sync: order_number: '.$order_header->order_number.' -----message:---- : posted successfully');

                }*/

                // Good Code
                $order_header->getswift_status = OrderHeader::DELIVERY_ADDED;

                if ($order_header->save())
                {
                    Log::info('user:'.auth()->user()->email. 'getswift order sync: order_number: '.$order_header->order_number.' -----message:---- : posted successfully');
                }

            }

            Auth::logout();
        }

    }

    private function mappingGetswiftFeilds($order_header , $getswift_key)
    {
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
                    //'deliveryInstructions' => $order_header->delivery_instruction, // need to add this deliveryInstruction in orderDetail model in orderheader table
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
                    'webhooks' =>
                        array(
                            [
                                'eventName' => 'job/added',
                                'url' => route('delivery.job.added', $order_header->id)
                            ],
                            [
                                'eventName' => 'job/accepted',
                                'url' => route('delivery.job.accepted', $order_header->id)
                            ],
                            [
                                'eventName' => 'job/driveratpickup',
                                'url' => route('delivery.job.driverpickup', $order_header->id)
                            ],
                            [
                                'eventName' => 'job/onway',
                                'url' => route('delivery.job.onway', $order_header->id)
                            ],
                            [
                                'eventName' => 'job/driveratdropoff',
                                'url' => route('delivery.job.driveratdropoff', $order_header->id)
                            ],
                            [
                                'eventName' => 'job/finished',
                                'url' => route('delivery.job.finished', $order_header->id)
                            ],
                            [
                                'eventName' => 'job/cancelled',
                                'url' => route('delivery.job.cancelled', $order_header->id)
                            ],

                        )
                        ),
                    );

        return $data;
    }
}
