<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrderHeader extends Model
{

    CONST DELIVERY_NEW = 'New'; //Posted to Blend but not sent to Get Swift
    CONST GETSWIFT_STATUS_POSTED = 'Posted'; //Sent to Get Swift
    CONST GETSWIFT_STATUS_READY_FOR_DELIVERY = 'Ready for Delivery'; //The signal to the driver that these are ready for pickup
    CONST GETSWIFT_STATUS_OUT_FOR_DELIVERY = 'Out for Delivery'; //When the driver starts the trip using Get Swift
    CONST GETSWIFT_STATUS_COMPLETE = 'Complete'; //After the driver drops off the packages and marks the order as delivered

    protected $guarded = [];

    protected $primaryKey = 'order_number';

    protected $appends = ['full_address'];

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

    public function storeInfo()
    {
        return $this->belongsTo(StoreInformation::class , 'store_number' , 'store_number');
    }

    public function getGetswiftStatusAttribute($val)
    {
        return (is_null($val) or $val == self::DELIVERY_NEW) ? self::DELIVERY_NEW : $val;
    }

    public function getFullAddressAttribute()
    {
        return $this->ship_to_addr_1.', '.$this->ship_to_addr_2.(!empty($this->ship_to_addr_2)?', ':'').$this->ship_to_addr_3;
    }
}
