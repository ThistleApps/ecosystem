<?php

namespace App\Http\Controllers;

use App\Jobs\MerchantDataTransectionJob;
use App\Models\AdminSetting;
use App\Models\OrderHeader;
use App\Models\Remote\ROrderHeader;
use App\Services\ApiRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Spark\Http\Controllers\Auth\PasswordController;

use Illuminate\Support\Facades\Artisan;
use Laravel\Spark\Spark;
use Symfony\Component\Process\Process;

class TestController extends Controller
{
    public function index(Request $request) {

        $getswift_key = auth()->user()->getMerchantGetswiftKey();

        $url = config('getswift.base_url').config('getswift.deliveries');

        $order_header = OrderHeader::query()->orderByDesc('id')->first();

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
                    'deliveryInstructions' => '',
                    'itemsRequirePurchase' => false,
                    'items' => $items,
                    'pickupTime' => Carbon::parse($order_header->creation_date)->format('Y-m-d\Th:m:s.000000+00:00'),
                    'pickupDetail' =>
                        array (
                            'name' => $order_store_info->long_name,
                            'phone' => $order_store_info->number,
                            'email' => '',
                            'description' => '',
                            'address' => $order_store_info->full_address,
                            'additionalAddressDetails' =>
                                array (
                                    'stateProvince' => 'abc', //required
                                    'country' => 'abc', //required
                                    'suburbLocality' => 'acb', //required
                                    'postcode' => $order_store_info->area_code,
                                    "latitude"=> 5.1, //required
                                    "longitude"=> 6.1 //required
                                ),
                        ),
                    'dropoffWindow' =>
                        array (
                            'earliestTime' => Carbon::parse($order_header->delivery_date)->format('Y-m-d\Th:m:s.000000+00:00'),
                            'latestTime' => Carbon::parse($order_header->delivery_date)->format('Y-m-d\Th:m:s.000000+00:00'),
                        ),
                    'dropoffDetail' =>
                        array (
                            'name' => $order_header->ship_to_name,
                            'phone' => $order_header->phone_no,
                            'email' => $order_header->ship_to_email_address,
                            'description' => '',
                            'address' => $order_header->full_address,
                            'additionalAddressDetails' =>
                                array (
                                    'stateProvince' => 'abc', //required
                                    'country' => 'abc', //required
                                    'suburbLocality' => 'abc', //required
                                    'postcode' => $order_header->area_code,
                                    'latitude' => 5.1, //required
                                    'longitude' => 6.3, //required
                                ),
                        ),
                    'customerFee' => 4, //???
                    'customerReference' => '12345', //???
                    'tax' => 1, //???
                    'taxInclusivePrice' => false, //???
                    'tip' => 1, //???
                    'driverFeePercentage' => 6, //???
                    'driverMatchCode' => '123123', //???
                    'deliverySequence' => 8, //???
                    'deliveryRouteIdentifier' => '123', //???

                ),
        );

        dd(json_encode($data));
        $req = ApiRequest::curlRequest($url , $data);

        return $req;
        dd();

//        $process = new Process('php artisan db:seed --class=AdminSettingsTableSeeder --force');
//
//        $process->setWorkingDirectory('../');
//        $process->run();
//        dd($process->getOutput());

//        (new \AdminSettingsTableSeeder())->run();
//        $this->dispatch(new MerchantDataTransectionJob(auth()->user()));
    }

    public function broker()
    {
        return Password::broker();
    }
}
