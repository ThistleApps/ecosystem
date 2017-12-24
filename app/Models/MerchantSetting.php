<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MerchantSetting extends Model
{
    CONST GETSWIFT_KEY_SLUG = 'getswift_key';
    CONST MERCHANT_ORDER_CODE_SLUG = 'merchant_order_code';
    protected $guarded = [];


    protected static function boot()
    {
        static::addGlobalScope('user_id', function (Builder $builder) {
            $builder->where('user_id', auth()->user()->id);
        });
    }
}
