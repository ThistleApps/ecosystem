<?php

namespace App\Models\Remote;

use App\Traits\RemoteConTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ROrderDetail extends Model
{
    use RemoteConTrait;

    protected $table= "OD";
    protected $connection = 'remote';

    protected static function boot()
    {
        static::addGlobalScope('select_fields', function (Builder $builder) {
            $builder->select(
                [
                    'od_transaction_number as transaction_number',
                    'od_ref_no as ref_no',
                    'od_sku_number as sku_number',
                    'od_delivery_date as delivery_date',
                    'od_selling_u_m as selling_u_m',
                    'od_qty_selling_units as qty_selling_units',
                    'od_item as item',
                    'od_description as description',
                    'od_cust_price as cust_price'
                ]
            );
        });
    }


}
