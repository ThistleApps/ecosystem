<?php
/**
 * Created by PhpStorm.
 * User: awais
 * Date: 1/15/2018
 * Time: 10:48 PM
 */


Route::group(['prefix' =>'/merchants' /*'middleware' => 'admin'*/] , function () {

    Route::get('/' , function (){
        return view('pages.merchants');
    })->name('admin.merchants');

    Route::get('/edit' , function (){
        return view('pages.edit-merchant');
    })->name('admin.merchants.edit');

});


Route::group(['prefix' => 'config-default'] ,  function () {

    Route::get('/' , [
        'as' => 'admin.config-default.index',
        'uses' => 'ConfigDefaultController@index'
    ]);
});


Route::group([/*'middleware' => ['admin', 'merchant']*/], function () {



    Route::get('/create/account' , function (){
        return view('pages.create-account');
    });

});