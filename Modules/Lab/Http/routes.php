<?php


Route::group(['middleware' => ['web','auth:admin'], 'prefix' => 'admin/lab', 'namespace' => 'Modules\Lab\Http\Controllers'], function()
{
    Route::get('/category', 'CategoryController@index')->name('lab-cat-index');
    Route::get('/category/create', 'CategoryController@create')->name('lab-cat-create');
    Route::post('/category/create', 'CategoryController@store')->name('lab-cat-store');
    Route::get('/category/edit/{id}', 'CategoryController@edit')->name('lab-cat-edit');
    Route::post('/category/update/{id}', 'CategoryController@update')->name('lab-cat-update');
    Route::get('/category/delete/{id}', 'CategoryController@destroy')->name('lab-cat-delete');
    Route::get('/category/status/{id1}/{id2}', 'CategoryController@status')->name('lab-cat-st');

    Route::get('/condition', 'LabConditionController@index')->name('lab-condition-index');
    Route::get('/condition/create', 'LabConditionController@create')->name('lab-condition-create');
    Route::post('/condition/create', 'LabConditionController@store')->name('lab-condition-store');
    Route::get('/condition/edit/{id}', 'LabConditionController@edit')->name('lab-condition-edit');
    Route::post('/condition/update/{id}', 'LabConditionController@update')->name('lab-condition-update');
    Route::get('/condition/delete/{id}', 'LabConditionController@destroy')->name('lab-condition-delete');
    Route::get('/condition/status/{id1}/{id2}', 'LabConditionController@status')->name('lab-condition-st');

    Route::get('/speciality', 'LabSpecialityController@index')->name('lab-speciality-index');
    Route::get('/speciality/create', 'LabSpecialityController@create')->name('lab-speciality-create');
    Route::post('/speciality/create', 'LabSpecialityController@store')->name('lab-speciality-store');
    Route::get('/speciality/edit/{id}', 'LabSpecialityController@edit')->name('lab-speciality-edit');
    Route::post('/speciality/update/{id}', 'LabSpecialityController@update')->name('lab-speciality-update');
    Route::get('/speciality/delete/{id}', 'LabSpecialityController@destroy')->name('lab-speciality-delete');
    Route::get('/speciality/status/{id1}/{id2}', 'LabSpecialityController@status')->name('lab-speciality-st');

    Route::get('/products', 'ProductController@index')->name('lab-prod-index');

    Route::get('/product/deactive', 'ProductController@deactive')->name('lab-prod-deactive');
    Route::get('/product/create', 'ProductController@create')->name('lab-prod-create');
    Route::post('/product/create', 'ProductController@store')->name('lab-prod-store');
    Route::get('/product/edit/{id}', 'ProductController@edit')->name('lab-prod-edit');
    Route::post('/product/update/{id}', 'ProductController@update')->name('lab-prod-update');
    Route::post('/product/feature/{id}', 'ProductController@feature')->name('lab-prod-feature');
    Route::get('/product/delete/{id}', 'ProductController@destroy')->name('lab-prod-delete');
    Route::get('/product/status/{id1}/{id2}', 'ProductController@status')->name('lab-prod-st');

    Route::get('/orders', 'AdminOrderController@index')->name('lab-order-index');
    Route::get('/order/{id}/show', 'AdminOrderController@show')->name('lab-order-show');
    Route::get('/order/{id}/invoice', 'AdminOrderController@invoice')->name('lab-order-invoice');
    Route::get('/order/{id}/print', 'AdminOrderController@printpage')->name('lab-order-print');
    Route::get('/order/{id1}/status/{status}', 'AdminOrderController@status')->name('lab-order-status');
    Route::post('/order/email/', 'AdminOrderController@emailsub')->name('lab-order-emailsub');
    Route::get('/report/{id}/{filename}', 'AdminOrderController@getReportFile')->name('lab-order-report');
});

Route::group(['middleware'=>['web','verified','vendor'], 'prefix' => 'user/vendor/lab', 'namespace' => 'Modules\Lab\Http\Controllers'],function(){

    Route::get('/product', 'UserProductController@index')->name('user-lab-prod-index');
    Route::get('/product/create', 'UserProductController@create')->name('user-lab-prod-create');
    Route::post('/product/create', 'UserProductController@store')->name('user-lab-prod-store');
    Route::get('/product/edit/{id}', 'UserProductController@edit')->name('user-lab-prod-edit');
    Route::post('/product/update/{id}', 'UserProductController@update')->name('user-lab-prod-update');
    Route::get('/product/delete/{id}', 'UserProductController@destroy')->name('user-lab-prod-delete');
    Route::get('/product/status/{id1}/{id2}', 'UserProductController@status')->name('user-lab-prod-st');

    Route::get('/orders', 'VendorOrderController@index')->name('vendor-lab-order-index');
    Route::get('/order/{slug}/show', 'VendorOrderController@show')->name('vendor-lab-order-show');
    Route::get('/order/{slug}/invoice', 'VendorOrderController@invoice')->name('vendor-lab-order-invoice');
    Route::get('/order/{slug}/print', 'VendorOrderController@printpage')->name('vendor-lab-order-print');
    Route::get('/order/{slug}/status/{status}', 'VendorOrderController@status')->name('vendor-lab-order-status');
    Route::post('/order/email/', 'VendorOrderController@emailsub')->name('vendor-lab-order-emailsub');
    Route::get('/report/{id}/{filename}', 'VendorOrderController@getReportFile')->name('vendor-lab-order-report');
    Route::post('/report/{id}/upload', 'VendorOrderController@uploadReportFile')->name('vendor-lab-order-uploadfile');
    Route::post('/report/{id}', 'VendorOrderController@removeReportFile')->name('vendor-lab-order-removefile');

});

Route::group(['middleware'=>['web','verified'], 'prefix' => 'user/lab', 'namespace' => 'Modules\Lab\Http\Controllers'],function(){

    Route::get('/orders', 'UserOrderController@index')->name('user-lab-order-index');
    Route::get('/order/{slug}/show', 'UserOrderController@show')->name('user-lab-order-show');
    Route::get('/order/{slug}/invoice', 'UserOrderController@invoice')->name('user-lab-order-invoice');
    Route::get('/order/{slug}/print', 'UserOrderController@printpage')->name('user-lab-order-print');
    Route::get('/report/{id}/{filename}', 'UserOrderController@getReportFile')->name('user-lab-order-report');

});

Route::group(['middleware'=>'web','prefix' => 'lab', 'namespace' => 'Modules\Lab\Http\Controllers\Frontend'],function(){

    Route::get('/', 'LabController@index')->name('lab.index');
    Route::get('/category/{slug}', 'LabController@category')->name('lab.category');
    Route::get('/tests/search', 'LabController@search')->name('lab.search');



    Route::get('/category/{slug}', 'LabController@category')->name('lab.category');
    // Route::get('/tests/search', 'LabController@search')->name('lab.search');
    Route::get('/compare', 'LabController@compare')->name('lab.compare');

    Route::get('/condition/{slug}', 'LabController@condition')->name('lab.condition');
    Route::get('/speciality/{slug}', 'LabController@speciality')->name('lab.speciality');
    Route::get('/alphabet/{slug}', 'LabController@alphabet')->name('lab.alphabet');

    Route::get('/cart', 'LabController@cart')->name('lab.cart');
    Route::get('/checkout', 'LabController@checkout')->name('lab.checkout')->middleware('auth:user');

    Route::post('/add-family', 'LabController@addFamily')->name('lab.addFamily')->middleware('auth:user');

    Route::post('/confirm', 'LabController@confirm')->name('lab.confirm')->middleware('auth:user');

    Route::group(['middleware'=>'auth:user'],function(){

        Route::post('/payment/{order_number}/gateway/cod', 'PaymentController@cashondelivery');
        Route::post('/payment/{order_number}/gateway/khalti', 'PaymentController@payWithKhalti');
        Route::post('/payment/{order_number}/gateway/fonepay', 'PaymentController@payWithFonePay');
        Route::post('/payment/{order_number}/gateway/esewa', 'PaymentController@payWithEsewa');
        Route::post('/payment/{order_number}/gateway/imepay', 'PaymentController@payWithIMEPay');
        Route::post('/payment/{order_number}/gateway/ipay', 'PaymentController@payWithIPay');
        Route::post('/payment/{order_number}/gateway/card', 'PaymentController@payWithCard');

        Route::post('payment/khalti/verify','PaymentController@khaltiVerification');
        Route::get('payment/{order_number}/fonepay/verify','PaymentController@verifyFonePay')->name('lab.payment.verify_fonepay');
        Route::post('payment/imepay/verify','PaymentController@verifyIMEPay')->name('lab.payment.verify_imepay');
        Route::get('payment/{order_number}/esewa/verify','PaymentController@verifyEsewa')->name('lab.payment.verify_esewa');
        Route::post('payment/{order_number}/ipay/verify','PaymentController@verifyIpay')->name('lab.payment.verify_ipay');
        Route::post('payment/card/verify','PaymentController@verifyCard')->name('lab.payment.verify_card');
        Route::post('payment/card/cancel','PaymentController@cancelCard')->name('lab.payment.cancel_card');

        Route::get('/payment/cancel', 'PaymentController@paycancel')->name('lab.payment.cancel');
        Route::get('/payment/return', 'PaymentController@payreturn')->name('lab.payment.return');

        Route::get('/payment/{order_number}', 'PaymentController@payment')->name('lab.payment');
    });

    Route::post('/json/addcart','JsonRequestController@addcart');
    Route::post('/json/removecart','JsonRequestController@removecart');
    Route::post('/json/emptycart','JsonRequestController@emptycart');

    Route::post('/json/compare','JsonRequestController@compare');
    Route::post('/json/comparesearch','JsonRequestController@comparesearch');
    Route::post('/json/addpackage','JsonRequestController@addpackage');
    Route::post('/json/testdetail','JsonRequestController@testdetail');
    // Route::post('/json/clearcompare','JsonRequestController@clearcompare');

});
