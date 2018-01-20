<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ConfigDefaultController extends Controller
{

    public function index() {
        return view('admin.config-default.index');
    }

    public function datatable() {


        $model = AdminSetting::query();

        return DataTables::of($model)
            ->addColumn('action', function ($settings) {
                return '<a href="javascript:void(0)" data-val="'.$settings->id.'" class="btn btn-xs btn-primary setting-editor"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })->toJson();
    }

    public function getSettingWithId($id) {
        return AdminSetting::findOrFail($id);
    }

    public function update(Request $request , $id) {
        $model = AdminSetting::findOrFail($id);

        $status = $model->update(['value' => $request->value]);

        if ($status)
            $notification = array(
                'message' => 'Value Updated successfully',
                'alert-type' => 'success'
            );
        else
            $notification = array(
                'message' => 'Value Not Updated successfully',
                'alert-type' => 'fail'
            );

        return back()->with($notification);
    }

}
