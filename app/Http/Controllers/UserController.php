<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * profile method;
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function index(){

        $user = Auth()->user();
        return view('user.profile' , compact('user'));
    }

    public function update(Request $request) {
        $user = auth()->user();
        $user->update($request->all());


        return back();
    }




}
