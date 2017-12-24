<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

function setRemoteConnection($host) {
    Config::set('database.connections.remote' , [
        'host'          => $host,
        'driver'        => 'mysql',
        'port'          => \config('database.remote.TEMP_DB_PORT', '3306'),
        'database'      => config('database.remote.TEMP_DB_DATABASE', 'forge'),
        'username'      => config('database.remote.TEMP_DB_USERNAME', 'forge'),
        'password'      => config('database.remote.TEMP_DB_PASSWORD', ''),
        'unix_socket'   => env('DB_SOCKET', ''),
        'charset'       => 'utf8mb4',
        'collation'     => 'utf8mb4_unicode_ci',
    ]);
}

function test_remote_connection($wan_address) {
    setRemoteConnection($wan_address);
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

?>