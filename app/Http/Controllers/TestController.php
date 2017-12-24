<?php

namespace App\Http\Controllers;

use App\Jobs\MerchantDataTransectionJob;
use App\Models\Remote\ROrderHeader;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index() {
        $this->dispatch(new MerchantDataTransectionJob(auth()->user()));
    }
}
