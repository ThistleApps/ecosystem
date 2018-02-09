<?php

namespace App\Http\Controllers;

use App\Jobs\MerchantDataTransectionJob;
use App\Models\AdminSetting;
use App\Models\Remote\ROrderHeader;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Laravel\Spark\Spark;
use Symfony\Component\Process\Process;

class TestController extends Controller
{
    public function index() {
        $process = new Process('php artisan db:seed --class=PosTypeSeeder --force');
        $process->setWorkingDirectory('../');
        $process->run();
        dd($process->getOutput());
//        (new \AdminSettingsTableSeeder())->run();
//        $this->dispatch(new MerchantDataTransectionJob(auth()->user()));
    }
}
