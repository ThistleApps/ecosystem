<?php

namespace App\Http\Controllers;

use App\Models\MerchantSetting;
use Illuminate\Http\Request;

class ConfiguratorController extends Controller
{
    public function index() {
        $settings = MerchantSetting::get();

        return view('configurator.configurator')->with([
            'getswift_key' => $settings->where('slug' , MerchantSetting::GETSWIFT_KEY_SLUG)->first(),
            'order_code'   => $settings->where('slug' , MerchantSetting::MERCHANT_ORDER_CODE_SLUG)->first()
        ]);
    }

    public function getswiftSettingsSave(Request $request) {

        if ($request->has('getswift_key')) {
            $settings_data = [
                'user_id'   => auth()->user()->id,
                'slug'      => MerchantSetting::GETSWIFT_KEY_SLUG,
            ];

            MerchantSetting::updateOrCreate($settings_data , ['key' => $request->getswift_key]);
        }

        if ($request->has('order_code') && $request->has('delivery_code'))  {
            $settings_data = [
                'user_id'   => auth()->user()->id,
                'slug'      => MerchantSetting::MERCHANT_ORDER_CODE_SLUG,
            ];

            MerchantSetting::updateOrCreate($settings_data , [ 'key' =>  $request->order_code, 'value' => $request->delivery_code]);
        }

        $notification = array(
            'message' => 'getswift Settings Saved Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }


}
