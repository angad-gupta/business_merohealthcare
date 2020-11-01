<?php

Route::group(['namespace' => 'Modules\Lab\Http\Controllers','prefix' => 'lab'],function() {
    Route::get('home','Api\LabController@index');   
    Route::get('category/{slug}','Api\LabController@category');
    Route::get('condition/{slug}', 'Api\LabController@condition');
    Route::get('speciality/{slug}', 'Api\LabController@speciality');
    Route::get('alphabet/{slug}', 'Api\LabController@alphabet');
    Route::post('compare','Api\JsonRequestController@compare');
    Route::post('comparesearch','Api\JsonRequestController@comparesearch');
    
});


Route::group(['middleware' => 'auth:api','namespace' => 'Modules\Lab\Http\Controllers','prefix' => 'lab'],function() {
   
    Route::post('book','Api\LabController@cart');
    Route::post('checkout','Api\LabController@checkout');
    Route::post('confirm-order','Api\LabController@confirm');
    Route::post('payment','Api\PaymentController@payment');
    
});