<?php
/**
 * Created by PhpStorm.
 * User: awais
 * Date: 1/15/2018
 * Time: 10:48 PM
 */

Route::get('logs', '\Melihovv\LaravelLogViewer\LaravelLogViewerController@index');
Route::group(['prefix' =>'/merchants'] , function () {

    Route::get('/' , [
        'as' => 'admin.merchants',
        'uses' => 'MerchantsController@index'
    ]);

    Route::get('/datatable' , [
        'as' => 'admin.merchants.datatable',
        'uses' => 'MerchantsController@getDatatable'
    ]);

    Route::get('{id}/edit' , [
        'as' => 'admin.merchants.edit',
        'uses' => 'MerchantsController@edit'
    ]);

    Route::get('passwordReset' , [
        'as' => 'admin.merchants.password-reset',
        'uses' => 'MerchantsController@resetMerchantEmail'
    ]);

    Route::post('test-connection' , [
        'as' => 'admin.merchants.test-connection',
        'uses' => 'MerchantsController@merchantTestConnection'
    ]);



    Route::put('{id}/update' , [
        'as' => 'admin.merchants.update',
        'uses' => 'MerchantsController@update'
    ]);

});


Route::group(['prefix' => 'config-default'] ,  function () {

    Route::get('/' , [
        'as' => 'admin.config-default.index',
        'uses' => 'ConfigDefaultController@index'
    ]);

    Route::get('/datatable' , [
        'as' => 'admin.config-default.datatable-data',
        'uses' => 'ConfigDefaultController@datatable'
    ]);

    Route::get('/datatable-editer' , [
        'as' => 'admin.config-default.datatable-editer',
        'uses' => 'ConfigDefaultController@datatableEditer'
    ]);

    Route::put('update/{id}' , [
        'as' => 'admin.config-default.update',
        'uses' => 'ConfigDefaultController@update'
    ]);

    Route::get('get/{id}' , [
        'as' => 'admin.config-default.get-record',
        'uses' => 'ConfigDefaultController@getSettingWithId'
    ]);



});


Route::group([/*'middleware' => ['admin', 'merchant']*/], function () {



    Route::get('/create/account' , function (){
        return view('pages.create-account');
    });

});