<?php

namespace App\Models\Remote;

use App\Traits\RemoteConTrait;
use Illuminate\Database\Eloquent\Model;

class ROrderDetail extends Model
{
    use RemoteConTrait;

    protected $table= "OD";

    protected $connection = 'remote';
}
