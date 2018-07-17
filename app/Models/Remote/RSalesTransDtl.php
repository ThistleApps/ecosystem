<?php

namespace App\Models\Remote;


use App\Traits\RemoteConTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RSalesTransDtl extends Model
{
    use RemoteConTrait;

    protected $primaryKey = 'dwsx_transaction';

    protected $table= "dw_sls_xaction_dtl";

    protected $connection = 'remote';

    protected static function boot()
    {
        static::addGlobalScope('dwsx_transaction', function (Builder $builder) {
            $builder->where('dwsx_transaction', '<>' , 0);
        });

        static::addGlobalScope('select_fields', function (Builder $builder) {
            $builder->select(
                [
                    'dwsx_store as store_number',
                    'dwsx_transaction as transaction_number',
                    'dwsx_customer as customer_number',
                    'dwsx_customer_name as customer_name',
                    'dwsx_customer_addr_1 as cust_addr_1',
                    'dwsx_customer_addr_2 as cust_addr_2',
                    'dwsx_customer_addr_3 as cust_addr_3',
                ]
            );
        });
    }

    public function transCustomers() {
        return $this->hasMany(RSalesTransDtlExt::class , 'dwsxe_transaction' , 'dwsx_transaction');
    }

    public function transStore() {
        return $this->hasOne(RStoreInfo::class , 'st_store_number','dwsx_store');
    }
}
