<?php
/**
 * Created by PhpStorm.
 * User: awais
 * Date: 12/12/2017
 * Time: 11:46 PM
 */

namespace App\Traits;


use Illuminate\Support\Facades\Auth;

trait RemoteConTrait
{
    protected static function boot() {
        parent::boot();

        $user = Auth::user();

        setRemoteConnection($user->pos_wan_address);
    }
}