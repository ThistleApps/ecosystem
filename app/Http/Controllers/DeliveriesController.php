<?php

namespace App\Http\Controllers;

use App\Jobs\MerchantDataTransectionJob;
use App\Models\OrderDetail;
use App\Models\OrderHeader;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DeliveriesController extends Controller
{
    public function index() {
        return view('deliveries.deliveries');
    }

    public function datatable(Request $request) {

//        return $request->all();
        $model = OrderHeader::query();

        if ($request->has('date_range') && !empty(trim($request->date_range)))
        {
            $date = explode(' - ' , $request->date_range);
            $date[0] = Carbon::parse($date[0])->toDateString();
            $date[1] = Carbon::parse($date[1])->toDateString();

            if (!empty(trim($request->date_range)) && !empty(trim($request->filter_on)) && $request->filter_on == 'order_date')
                $model = $model->where('delivery_date' ,'>=', $date[0])->where('delivery_date' ,'<=', $date[1]);
            if (!empty(trim($request->date_range)) && !empty(trim($request->filter_on)) && $request->filter_on == 'creation_date')
                $model = $model->where('creation_date' ,'>=', $date[0])->where('creation_date' ,'<=', $date[1]);
        }

        if(!empty(trim($request->status)) )
            $model = $model->where('status' , $request->status);

        if(!empty(trim($request->store_number)) )
            $model = $model->where('store_number' , $request->store_number);


        return DataTables::of($model)
            ->addColumn('action', function ($order){
                $resetbutton =$edit = '';
                if ($order->getswift_status == OrderHeader::DELIVERY_CANCELLED)
                $resetbutton = "<button class='btn btn-danger od-reset-btn' data-id='".$order->order_number."'>Reset</button>";
                if ($order->getswift_status == OrderHeader::DELIVERY_CANCELLED or $order->getswift_status == null or $order->getswift_status == OrderHeader::DELIVERY_NEW)
                $edit = "<a href='".route('deliveries.edit' , $order->id)."'  class='btn btn-primary btn-sm-block' data-id='".$order->order_number."'>edit</a>";
                return "<div class='btn-group btn-group-xs'>".$resetbutton.$edit.'</div>';
            })
            ->setRowClass(function ($order) {
                return $order->getswift_status == OrderHeader::DELIVERY_CANCELLED ? 'background-col' : '';
            })
            ->make(true);
    }

    public function orderDetails($order_number) {
        $order_header = OrderHeader::findOrFail($order_number);

        return $order_header->orderDetails;
    }

    public function fetchOrdersNow() {
//        try
//        {
            $user = auth()->user();
            $this->dispatch(new MerchantDataTransectionJob($user));

            $notification = array(
                'message' => 'Remote Orders Fetched Successfully',
                'alert-type' => 'success'
            );

//        }catch (\Exception $exception) {
//            $notification = array(
//                'message' => $exception->getMessage(),
//                'alert-type' => 'error'
//            );
//        }

        return back()->with($notification);
    }

    public function edit($id)
    {
        $delivery = OrderHeader::find($id);

        return view('deliveries.edit', compact('delivery'));
    }

    public function update(Request $request, $id)
    {
        $delivery = OrderHeader::find($id);
        $delivery->update($request->all());

        return back();
    }

    public function itemRemove(Request $request)
    {
        OrderDetail::where('id', $request->id)->delete();

        $notification = array(
            'message' => 'Item removed Successfully',
            'alert-type' => 'success'
        );
        return response()->json($notification);
    }

    public function itemUpdate(Request $request)
    {
//        dd($request->all());
    }

    public function getswiftReset($id)
    {
        $delivery = OrderHeader::findOrFail($id);

        $delivery->update(['getswift_status' => null]);

        return back();
    }
}
