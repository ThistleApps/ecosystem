<?php

namespace App\Http\Controllers;

use App\Jobs\MerchantDataTransectionJob;
use App\Models\AdminSetting;
use App\Models\Remote\ROrderHeader;
use App\User;
use Illuminate\Http\Request;
use Laravel\Spark\Http\Controllers\Auth\PasswordController;

use Illuminate\Support\Facades\Artisan;
use Laravel\Spark\Spark;
use Symfony\Component\Process\Process;

class TestController extends Controller
{
    public function index(Request $request) {

//        $this->validate($request, ['email' => 'required|email']);
//
//        $broker = $response = $this->broker()->sendResetLink(
//            $request->only('email')
//        );
//        dd($broker);
//        $view = (new PasswordController())->sendResetLinkEmail($request);
//        dd($view);
//        $process = new Process('php artisan db:seed --class=PosTypeSeeder --force');
//        $process = new Process('ls');
//        $process->setWorkingDirectory('../storage/logs/la');
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
