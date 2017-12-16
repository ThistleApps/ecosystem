<?php

namespace App\Models\Remote;

use App\Traits\RemoteConTrait;
use Illuminate\Database\Eloquent\Model;

class RStoreInfo extends Model
{
    use RemoteConTrait;

    protected $table= "OH";

    protected $connection = 'remote';
}
