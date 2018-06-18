<?php

use Illuminate\Support\Facades\Route;

Route::get('job/added/{order_id}' , 'WebhookEventController@jobAdded')->name('delivery.job.added');
Route::get('job/accepted/{order_id}' , 'WebhookEventController@jobAdded')->name('delivery.job.accepted');
Route::get('job/driveratpickup/{order_id}' , 'WebhookEventController@jobDriverAtPickup')->name('delivery.job.driverpickup');
Route::get('job/onway/{order_id}' , 'WebhookEventController@jobOnway')->name('delivery.job.onway');
Route::get('job/driveratdropoff/{order_id}' , 'WebhookEventController@jobDriverAtDropOff')->name('delivery.job.driveratdropoff');
Route::get('job/finished/{order_id}' , 'WebhookEventController@jobFinished')->name('delivery.job.finished');
Route::get('job/cancelled/{order_id}' , 'WebhookEventController@jobCancelled')->name('delivery.job.cancelled');
