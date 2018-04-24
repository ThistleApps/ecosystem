<?php

namespace App\Models\Remote;

use App\Traits\RemoteConTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RStoreInfo extends Model
{
    use RemoteConTrait;

    protected $table= "ST";

    protected $connection = 'remote';

    protected $primaryKey = 'st_store_number';

    protected static function boot()
    {
        static::addGlobalScope('select_fields', function (Builder $builder) {
            $builder->select(
                [
                    'st_store_number as store_number',
                    'st_long_name as long_name',
                    'st_short_name as short_name',
                    'st_addr_line1 as addr_line1',
                    'st_addr_line2 as addr_line2',
                    'st_addr_line3 as addr_line3',
                    'st_zone as zone',
                    'st_area_code as area_code',
                    'st_number as number',
                ]
            );
        });
    }

}
