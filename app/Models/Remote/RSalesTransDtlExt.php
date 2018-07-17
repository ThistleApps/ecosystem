<?php

namespace App\Models\Remote;

use App\Traits\RemoteConTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RSalesTransDtlExt extends Model
{
    use RemoteConTrait;

    protected $table= "dw_sls_xaction_dtl_e";
    protected $connection = 'remote';

    protected static function boot()
    {
        static::addGlobalScope('select_fields', function (Builder $builder) {
            $builder->select(
                [
                    'dwsxe_ship_to_email_address'
                ]
            );
        });
    }


}
