<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MerchantSetting extends Model
{
    const GETSWIFT_KEY_SLUG                = 'getswift_key';
    const MERCHANT_ORDER_CODE_SLUG         = 'merchant_order_code';
    const MAILCHIMP_TOKEN_SLUG             = 'mailchimp_token';
    const MAILCHIMP_CUSTOMERS_LIST_SLUG    = 'mailchimp_customers_list_id';
    const MAILCHIMP_TRANSACTIONS_LIST_SLUG = 'mailchimp_transactions_list_id';

    protected $guarded = [];

    protected static function boot()
    {
        if (!app()->runningInConsole()) {
            static::addGlobalScope('user_id', function (Builder $builder) {
                $builder->where('user_id', auth()->user()->id);
            });
        }
    }
}
