<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@show');

Route::get('/home', 'HomeController@show');


Route::get('/deliveries' , function (){
    return view('pages.deliveries');
});

Route::get('/configs' , function (){
    return view('pages.configs-default');
});

Route::get('/merchants' , function (){
    return view('pages.merchants');
});

Route::get('/merchants/edit' , function (){
    return view('pages.edit-merchant');
});