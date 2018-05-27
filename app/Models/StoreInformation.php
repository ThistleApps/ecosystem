<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class StoreInformation extends Model
{
    protected $primaryKey = 'store_number';

    protected $table = 'store_information';

    protected $guarded = [];

    protected $appends = ['full_address'];

    public function getFullAddressAttribute()
    {
        return $this->addr_line1.', '.$this->addr_line2.(!empty($this->addr_line2)?', ':'').$this->addr_line3;
    }

    protected static function boot()
    {

        static::addGlobalScope('user_id', function (Builder $builder) {
            $builder->where('user_id', auth()->user()->id);
        });
    }


}
