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
    'as'   => 'integrator',
    'uses' => 'IntegratorController@index',
]);

Route::get('/testchart', 'HomeController@show');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@show');

    Route::get('/profile', [
        'as'   => 'user.profile',
        'uses' => 'UserController@index',
    ]);

    Route::post('/profile/update', [
        'as'   => 'user.profile.update',
        'uses' => 'UserController@update',
    ]);

    Route::post('/profile/test-connection', [
        'as'   => 'user.profile.test.connection',
        'uses' => 'UserController@TestConnection',
    ]);

    Route::group(['prefix' => 'configurator'], function () {
        Route::get('/', [
            'as'   => 'configurator.index',
            'uses' => 'ConfiguratorController@index',
        ]);

        Route::post('/getswift', [
            'as'   => 'configurator.getswift.save',
            'uses' => 'ConfiguratorController@getswiftSettingsSave',
        ]);

        Route::get('mailchimp', [
            'as'   => 'configurator.mailchimp.auth',
            'uses' => 'ConfiguratorController@mailchimpAuth',
        ]);

        Route::post('mailchimp', [
            'as'   => 'configurator.mailchimp.save',
            'uses' => 'ConfiguratorController@mailchimpSave',
        ]);
    });

    Route::group(['prefix' => 'deliveries'] , function () {

        Route::get('/' , [
            'as' => 'deliveries.index',
            'uses' => 'DeliveriesController@index'
        ]);

        Route::get('/{id}/edit' , [
            'as' => 'deliveries.edit',
            'uses' => 'DeliveriesController@edit'
        ]);

        Route::get('/{id}/getswift-reset' , [
            'as' => 'deliveries.getswift.reset',
            'uses' => 'DeliveriesController@getswiftReset'
        ]);

        Route::post('/item/update' , [
            'as' => 'deliveries.item.update',
            'uses' => 'DeliveriesController@itemUpdate'
        ]);

        Route::put('/{id}/update' , [
            'as' => 'deliveries.update',
            'uses' => 'DeliveriesController@update'
        ]);


        Route::post('/item/remove' , [
            'as' => 'deliveries.item.remove',
            'uses' => 'DeliveriesController@itemRemove'
        ]);



        Route::get('/datatable' , [
            'as' => 'deliveries.datatable',
            'uses' => 'DeliveriesController@datatable'
        ]);

        Route::get('order-details/{order_number}', [
            'as'   => 'deliveries.order-details',
            'uses' => 'DeliveriesController@orderDetails',
        ]);

        Route::get('fetch-new-orders', [
            'as'   => 'deliveries.fetch-new-orders',
            'uses' => 'DeliveriesController@fetchOrdersNow',
        ]);
    });
});
