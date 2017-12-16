<?php

use Illuminate\Support\Facades\Config;

function setRemoteConnection($host) {
    Config::set('database.connections.remote' , [
        'host'   => $host,
        'driver' => 'mysql',
        'port' => env('TEMP_DB_PORT', '3306'),
        'database' => env('TEMP_DB_DATABASE', 'forge'),
        'username' => env('TEMP_DB_USERNAME', 'forge'),
        'password' => env('TEMP_DB_PASSWORD', ''),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
    ]);
}



?>