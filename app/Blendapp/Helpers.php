<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

function setRemoteConnection($host , $user = null , $individual_cred = null) {

    $db_Default_settings = \App\Models\AdminSetting::query()->where('scope' , 'Merchant DB')->get();

    if ($individual_cred && isset($individual_cred['db_name']) && isset($individual_cred['pos_mysql_un']) && isset($individual_cred['pos_mysql_pw']))
    {
        $db_un = $individual_cred['pos_mysql_un'];
        $db_pw = $individual_cred['pos_mysql_pw'];
        $db_name = $individual_cred['db_name'];
    }
    elseif ($user->pos_mysql_un && $user->pos_mysql_pw && !empty($user->pos_mysql_un) && !empty($user->pos_mysql_pw))
    {
        $db_un = $user->pos_mysql_un;
        $db_pw = $user->pos_mysql_pw;
        $db_name = $user->db_name;
    }
    else
    {
        $db_name = @$db_Default_settings->where('slug' , \App\Models\AdminSetting::DEF_DB_NAME)->first()->value;
        $db_un = @$db_Default_settings->where('slug' , \App\Models\AdminSetting::DEF_DB_UN)->first()->value;
        $db_pw = @$db_Default_settings->where('slug' , \App\Models\AdminSetting::DEF_DB_PW)->first()->value;
    }


    Config::set('database.connections.remote' , [
        'host'          => $host,
        'driver'        => 'mysql',
        'port'          => \config('database.remote.TEMP_DB_PORT', '3306'),
        'database'      => $db_name,
        'username'      => $db_un,
        'password'      => $db_pw,
        'unix_socket'   => env('DB_SOCKET', ''),
        'charset'       => 'utf8mb4',
        'collation'     => 'utf8mb4_unicode_ci',
    ]);
}

function test_remote_connection($wan_address , $user = null , $individual_cred = null) {

    setRemoteConnection($wan_address , $user , $individual_cred);
    try {
        $status = DB::connection('remote')->getPdo();

    } catch (\Exception $e) {
        $status = false;
    }

    return $status?true:false;
}

function order_codes() {
    return [
        'oh_transaction_code_1' => 'Code 1',
        'oh_transaction_code_2' => 'Code 2',
        'oh_transaction_code_3' => 'Code 3',
        'oh_transaction_code_4' => 'Code 4',
    ];
}


function setEnvValue($environmentName, $configKey, $newValue) {

    if (!empty(trim($newValue)) && Config::get($configKey) != $newValue)
    {
        file_put_contents(App::environmentFilePath(), str_replace(
            $environmentName . '=' . Config::get($configKey),
            $environmentName . '=' . $newValue,
            file_get_contents(App::environmentFilePath())
        ));

        Config::set($configKey, $newValue);

        // Reload the cached config
        if (file_exists(App::getCachedConfigPath())) {
            Artisan::call("config:cache");
        }
    }
}

?>