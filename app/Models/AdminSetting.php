<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    CONST DEF_DB_UN = 'def_db_un';
    CONST DEF_DB_PW = 'def_db_pw';
    CONST DEF_DB_NAME = 'def_db_name';
    CONST DEF_STRIPE_TEST = 'stripe_test';
    CONST DEF_STRIPE_LIVE = 'stripe_live';

    protected $guarded = [];
}
