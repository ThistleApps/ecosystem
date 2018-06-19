<?php

namespace App\Http\Controllers;

use App\Models\MerchantSetting;
use App\Services\MailchimpService;
use Illuminate\Http\Request;

class ConfiguratorController extends Controller
{
    public function index()
    {
        $settings = MerchantSetting::get();

        $mc_service = new MailchimpService(auth()->user());
        $mc_valid   = $mc_service->isValidToken;
        $mc_lists   = $mc_valid ? $mc_service->getLists() : null;
        $mc_lists   = collect($mc_lists['lists'])->pluck('name', 'id');

        return view('configurator.configurator')->with([
            'getswift_key'   => $settings->where('slug', MerchantSetting::GETSWIFT_KEY_SLUG)->first(),
            'order_code'     => $settings->where('slug', MerchantSetting::MERCHANT_ORDER_CODE_SLUG)->first(),
            'mc_customer'    => $settings->where('slug', MerchantSetting::MAILCHIMP_CUSTOMERS_LIST_SLUG)->first(),
            'mc_transaction' => $settings->where('slug', MerchantSetting::MAILCHIMP_TRANSACTIONS_LIST_SLUG)->first(),
            'mc_valid'       => $mc_valid,
            'mc_lists'       => $mc_lists,
        ]);
    }

    public function getswiftSettingsSave(Request $request)
    {
        if ($request->has('getswift_key')) {
            $settings_data = [
                'user_id' => auth()->user()->id,
                'slug'    => MerchantSetting::GETSWIFT_KEY_SLUG,
            ];

            MerchantSetting::updateOrCreate($settings_data, ['key' => $request->getswift_key]);
        }

        if ($request->has('order_code') && $request->has('delivery_code')) {
            $settings_data = [
                'user_id' => auth()->user()->id,
                'slug'    => MerchantSetting::MERCHANT_ORDER_CODE_SLUG,
            ];

            MerchantSetting::updateOrCreate($settings_data, ['key' => $request->order_code, 'value' => $request->delivery_code]);
        }

        $notification = array(
            'message'    => 'getswift Settings Saved Successfully',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function mailchimpAuth(Request $request)
    {
        $provider = (new MailchimpService(auth()->user()))->provider;

        // OAuth2 authorization
        if (!$request->code) {
            $authUrl = $provider->getAuthorizationUrl();
            session(['oauth2state' => $provider->getState()]);

            return redirect($authUrl);
        } elseif (empty(session('oauth2state')) || $request->state !== session('oauth2state')) {
            session()->forget('oauth2state');

            return abort(401, 'Invalid state.');
        }

        // Retrieve token after authorization
        try {
            $token = $provider->getAccessToken('authorization_code', ['code' => $request->code]);
            $dc    = $provider->getResourceOwner($token)->toArray()['dc'];
        } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
            report($e);
        }

        auth()->user()->merchantSettings()->create([
            'slug'  => MerchantSetting::MAILCHIMP_TOKEN_SLUG,
            'key'   => $dc,
            'value' => $token->getToken(),
        ]);

        return redirect()->route('configurator.index');
    }

    public function mailchimpSave(Request $request)
    {
        $user = auth()->user();

        $user->merchantSettings()->updateOrCreate(
            ['slug' => MerchantSetting::MAILCHIMP_CUSTOMERS_LIST_SLUG],
            ['key' => $request->customers_list]
        );

        $user->merchantSettings()->updateOrCreate(
            ['slug' => MerchantSetting::MAILCHIMP_TRANSACTIONS_LIST_SLUG],
            ['key' => $request->transactions_list]
        );

        return redirect()->route('configurator.index');
    }
}
