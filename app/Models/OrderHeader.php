<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrderHeader extends Model
{
    protected $guarded = [];

    protected $primaryKey = 'order_number';

    protected static function boot()
    {
        static::addGlobalScope('order_number', function (Builder $builder) {
            $builder->where('order_number', '<>' , 0);
        });

        static::addGlobalScope('user_id', function (Builder $builder) {
            $builder->where('user_id', auth()->user()->id);
        });
    }

    public function setDeliveryDateAttribute($value) {
        $this->attributes['delivery_date'] = $value == '0000-00-00'?null:$value;
    }

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class , 'transaction_number' , 'order_number');
    }
}
