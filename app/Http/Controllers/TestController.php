<?php

namespace App\Http\Controllers;

use App\Models\Remote\ROrderHeader;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index() {
        $orders_headers = ROrderHeader::limit(10)->get();
        dd($orders_headers);
    }
}
