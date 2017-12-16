<?php

use Illuminate\Support\Facades\Config;

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



?>