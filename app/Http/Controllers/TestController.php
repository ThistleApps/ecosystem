<?php

namespace App\Http\Controllers;

use App\Jobs\MerchantDataTransectionJob;
use App\Models\AdminSetting;
use App\Models\OrderHeader;
use App\Models\Remote\ROrderHeader;
use App\Services\ApiRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Spark\Http\Controllers\Auth\PasswordController;

use Illuminate\Support\Facades\Artisan;
use Laravel\Spark\Spark;
use Symfony\Component\Process\Process;

class TestController extends Controller
{
    public function index(Request $request) {

//        $process = new Process('php artisan db:seed --class=AdminSettingsTableSeeder --force');
//
//        $process->setWorkingDirectory('../');
//        $process->run();
//        dd($process->getOutput());

//        (new \AdminSettingsTableSeeder())->run();
//        $this->dispatch(new MerchantDataTransectionJob(auth()->user()));
    }

    public function broker()
    {
        return Password::broker();
    }
}
