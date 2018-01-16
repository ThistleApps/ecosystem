<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigDefaultController extends Controller
{
    public function index() {
        return view('admin.config-default.index');
    }
}
