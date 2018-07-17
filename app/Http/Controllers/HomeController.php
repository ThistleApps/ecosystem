<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

        // $this->middleware('subscribed');
    }



    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function show()
    {
        $userorders = DB::table('order_headers')->where('user_id', auth()->user()->id);
        $ordercount = $userorders->where('status', 'active')->count();

        $usertickets = DB::table('ticketit')->where('user_id', auth()->user()->id);
        $ticketcount = $usertickets->where('status_id', '1')->count();

        return view('home', ['ordercount' => $ordercount], ['ticketcount' => $ticketcount]);
    }
}
