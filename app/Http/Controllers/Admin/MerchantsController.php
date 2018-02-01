<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MerchantUpdateRequest;
use App\Models\AdminSetting;
use App\Models\PosType;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class MerchantsController extends Controller
{
    public function index()
    {
        return view('admin.merchant.index');
    }

    public function getDatatable() {
        try
        {

            $model = User::query();

            return DataTables::of($model)
                ->addColumn('subscription_plan' , function ($merchant) {
                    return $merchant->sparkPlan()->name;
                })
                ->addColumn('active' , function ($merchant) {
                    return $merchant->is_active?"Activated":"Deactivated";
                })
                ->addColumn('posType' , function ($merchant) {
                    return @$merchant->posType->name;
                })
                ->addColumn('action', function ($merchant) {
                    return '<td><a href="'.route('admin.merchants.edit' , $merchant->id).'" ><span class="fa fa-pencil-square-o"></span></a></td>';
                })->toJson();
        }Catch(\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function edit($id) {
        $pos_types = PosType::all();
        return view('admin.merchant.edit' , compact('pos_types'))
            ->with('merchant' , User::find($id) );
    }

    public function update(MerchantUpdateRequest $request, $id) {
        $merchant = User::findOrFail($id);

        $merchant->update($request->except('_pass_rest'));

        $merchant->pos_mysql_un = $request->pos_mysql_un;
        $merchant->pos_mysql_pw = $request->pos_mysql_pw;

        if ($request->has('password') && !empty(trim($request->password)) )
            $merchant->password = bcrypt($request->password);
        if ($request->has('_pass_rest') && $request->get('_pass_rest') == true)
            $merchant->password = "";

        $merchant->save();

        return back()->with([
            'message' => 'Merchant Updated Successfully',
            'alert-type' => 'success'
        ]);
    }
}
