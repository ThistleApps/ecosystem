<?php

namespace App\Http\Controllers;

use App\Jobs\MerchantDataTransectionJob;
use App\Models\AdminSetting;
use App\Models\Remote\ROrderHeader;
use App\User;
use Illuminate\Http\Request;
use Laravel\Spark\Spark;

class TestController extends Controller
{
    public function index() {
        dd(auth()->user()->posType);
//        (new \AdminSettingsTableSeeder())->run();
//        $this->dispatch(new MerchantDataTransectionJob(auth()->user()));
    }
}
