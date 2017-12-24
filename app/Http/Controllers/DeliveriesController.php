<?php

namespace App\Http\Controllers;

use App\Models\OrderHeader;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DeliveriesController extends Controller
{
    public function index() {
        return view('deliveries.deliveries');
    }

    public function datatable() {
        $model = OrderHeader::query();

        return DataTables::of($model)->toJson();
    }
}
