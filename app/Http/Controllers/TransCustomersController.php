<?php

namespace App\Http\Controllers;

use App\Jobs\MerchantDataTransectionJob;
use App\Models\Remote\RSalesTransDtl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransCustomersController extends Controller
{
    public function index() {
        $transemails = RSalesTransDtl::orderBy('dwsx_transaction')->get();
        return response()->json($transemails);
        //('customers.transcustomers');
//        var_dump($transemails);
    }

//    public function datatable(Request $request) {
//
////        return $request->all();
//        $model = RSalesTransDtl::query();
//

//        if ($request->has('date_range') && !empty(trim($request->date_range)))
//        {
//            $date = explode(' - ' , $request->date_range);
//            $date[0] = Carbon::parse($date[0])->toDateString();
//            $date[1] = Carbon::parse($date[1])->toDateString();
//
//            if (!empty(trim($request->date_range)) && !empty(trim($request->filter_on)) && $request->filter_on == 'order_date')
//                $model = $model->where('delivery_date' ,'>=', $date[0])->where('delivery_date' ,'<=', $date[1]);
//            if (!empty(trim($request->date_range)) && !empty(trim($request->filter_on)) && $request->filter_on == 'order_due_date')
//                $model = $model->where('expiration_date' ,'>=', $date[0])->where('expiration_date' ,'<=', $date[1]);
//        }
//
//        if(!empty(trim($request->status)) )
//            $model = $model->where('status' , $request->status);
//
//
//        return DataTables::of($model)->toJson();
//    }
//
//    public function orderDetails($order_number) {
//        $order_header = OrderHeader::findOrFail($order_number);
//
//        return $order_header->orderDetails;
//    }
//
//    public function fetchTransCustomersNow() {
////        try
////        {
//            $user = auth()->user();
//            $this->dispatch(new TransCustomersJob($user));
//
//            $notification = array(
//                'message' => 'Contacts have been collected from POS transactions',
//                'alert-type' => 'success'
//            );
//
////        }catch (\Exception $exception) {
////            $notification = array(
////                'message' => $exception->getMessage(),
////                'alert-type' => 'error'
////            );
////        }
//
//        return back()->with($notification);
//    }
}
