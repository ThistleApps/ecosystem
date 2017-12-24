<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * profile method;
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function index(){

        $user = Auth()->user();
        $pos_types = \App\Models\PosType::all();
        return view('user.profile' , compact('user', 'pos_types'));
    }

    public function update(Request $request) {
        $user = auth()->user();
        $user->update($request->all());

        $notification = array(
            'message' => 'Profile Updated successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    public function TestConnection(Request $request) {
        // Test database connection
        $status = test_remote_connection($request->get('pos_wan_address'));

        if ($status)
        {
            $notification = array(
                'message' => 'Connection Connected Successfully',
                'alert_type' => true
            );
        }
        else
        {
            $notification = array(
                'message' => 'System not able to connect',
                'alert_type' => false
            );
        }

        return $notification;
    }




}
