<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use App\Charts\DeliveriesTest;
use App\Charts\DeliveriesTest2;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('subscribed');
    }



    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function show()
    {
        $ID = auth()->user()->id;
        $date = Carbon::today()->toDateString();
        $today = Carbon::today();

        $userorders = DB::table('order_headers')->where('user_id', $ID);
        $ordercount = $userorders->where('status', 'active')->count();

        $usertickets = DB::table('ticketit')->where('user_id', $ID);
        $ticketcount = $usertickets->where('status_id', '1')->count();

        $modified_date = Carbon::today()->addDay(5);

        $userorderstoday = DB::table('order_headers')->where('user_id', $ID);
        $deliveriesToday = $userorderstoday->whereDate('delivery_date', '=', $today)->count();

        $deliveryOrders = $userorders->where('delivery_date','>',$today)->where('delivery_date','<', $modified_date->endOfDay())->count();

        $chart = new DeliveriesTest2();
        $chart ->labels(['Active Orders','Deliveries Today', 'Deliveries Next 5']);
        $chart->dataset('Deliveries', 'bar', [$ordercount,$deliveriesToday,$deliveryOrders]);

        return view('home', ['chart' => $chart,'date' =>$date, 'ordercount' => $ordercount, 'deliveryOrders' => $deliveryOrders, 'modified_date' =>$modified_date, 'ticketcount' => $ticketcount, 'deliveriesToday' => $deliveriesToday]);
    }
}
