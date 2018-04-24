<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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


}
