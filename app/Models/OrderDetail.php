<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{

    protected $guarded = [];

    public function setDeliveryDateAttribute($value) {
        $this->attributes['delivery_date'] = $value == '0000-00-00'?null:$value;
    }
//    protected static function boot()
//    {
//        static::addGlobalScope('user_id', function (Builder $builder) {
//            $builder->where('user_id', auth()->user()->id);
//        });
//    }

}
