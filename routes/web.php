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

Route::get('/', [
    'as'    => 'integrator',
    'uses'  => 'IntegratorController@index'
]);

Route::get('/home', 'HomeController@show');

Route::group(['middleware' => ['auth', 'merchant']] , function () {

    Route::get('/profile' , [
        'as'    => 'user.profile',
        'uses'  => 'UserController@index'
    ]);

    Route::post('/profile/update', [
        'as'    => 'user.profile.update',
        'uses'  => 'UserController@update'
    ]);

    Route::post('/profile/test-connection', [
        'as'    => 'user.profile.test.connection',
        'uses'  => 'UserController@TestConnection'
    ]);

});

Route::group(['middleware' => 'admin'] , function () {

    Route::get('/merchants' , function (){
        return view('pages.merchants');
    });

    Route::get('/merchants/edit' , function (){
        return view('pages.edit-merchant');
    });

});

Route::group(['middleware' => ['admin', 'merchant']], function () {

    Route::get('/create/account' , function (){
        return view('pages.create-account');
    });

    Route::get('/deliveries' , function (){
        return view('pages.deliveries');
    });

    Route::get('/configs' , function (){
        return view('pages.configs-default');
    });

    Route::get('/configurator' , function (){
        return view('pages.configurator');
    });
});