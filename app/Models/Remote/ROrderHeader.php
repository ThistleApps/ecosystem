<?php

namespace App\Models\Remote;

use App\Models\OrderDetail;
use App\Traits\RemoteConTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ROrderHeader extends Model
{
    use RemoteConTrait;

    protected $primaryKey = 'oh_order_number';

    protected $table= "OH";

    protected $connection = 'remote';

    protected static function boot()
    {
        static::addGlobalScope('oh_order_number', function (Builder $builder) {
            $builder->where('oh_order_number', '<>' , 0);
        });

        static::addGlobalScope('select_fields', function (Builder $builder) {
            $builder->select(
                [
                    'oh_store_number as store_number',
                    'oh_job_number as job_number',
                    'oh_order_number as order_number',
                    'oh_customer_name as customer_name',
                    'oh_customer_number as customer_number',
                    'oh_ship_to_name as ship_to_name',
                    'oh_ship_to_addr_1 as ship_to_addr_1',
                    'oh_ship_to_addr_2 as ship_to_addr_2',
                    'oh_ship_to_addr_3 as ship_to_addr_3',
                    'oh_ship_to_email_address as ship_to_email_address',
                    'oh_area_code as area_code',
                    'oh_phone_no as phone_no',
                    'oh_special_line_1 as special_line_1',
                    'oh_special_line_2 as special_line_2',
                    'oh_reference as reference',
                    'oh_creation_date as creation_date',
                    'oh_delivery_date as delivery_date',
                    'oh_clerk as clerk',
                    'oh_transaction_code_1 as transaction_code_1',
                    'oh_transaction_code_2 as transaction_code_2',
                    'oh_transaction_code_3 as transaction_code_3',
                    'oh_transaction_code_4 as transaction_code_4',
                ]
            );
        });
    }

    public function orderDetails() {
        return $this->hasMany(ROrderDetail::class , 'od_transaction_number' , 'order_number');
    }

    public function orderStore() {
        return $this->hasOne(RStoreInfo::class , 'st_store_number','store_number');
    }
}
