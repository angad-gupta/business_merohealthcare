<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('ecommerce')->group(function() {
    Route::get('/home','Api\AppController@HomePage');
    Route::get('/category/{slug}','Api\AppController@Categories');
    Route::get('product/{id}','Api\AppController@Product');
    Route::get('products/{slug}','Api\AppController@ChildCategory');
    Route::get('search/{search}','Api\AppController@Search');
    Route::get('medicine-search/{search}','Api\AppController@MedicineSearch');
    Route::post('/checkout/{order_number}/gateway/khalti', 'PaymentController@payWithKhalti');
    Route::post('/checkout/{order_number}/gateway/esewa', 'PaymentController@payWithEsewa');
    Route::get('checkout/{order_number}/esewa/verify','Api\PaymentController@verifyEsewa');
    Route::post('checkout/khalti/verify','Api\PaymentController@khaltiVerification');
    Route::post('checkout/{order_number}/gateway/cod','Api\PaymentController@cashondelivery');
    Route::get('checkout/{order_number}/fonepay/verify','Api\PaymentController@verifyFonePay');

    Route::post('checkout','Api\PaymentController@store');
    Route::post('payment','Api\PaymentController@payment');

    Route::get('gateways','Api\PaymentController@payment');
});

Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');
Route::get('signin/{provider}/callback', 'Api\SocialLoginController@handleProviderCallback');
Route::post('resend-email', 'Api\AuthController@resendConfirmation');
Route::post('/password/reset', 'Api\PasswordResetController@sendResetLinkEmail');

Route::post('/upload-prescription','Api\AppController@uploadPrescription');

Route::middleware('auth:api')->prefix('user')->group(function() {
    Route::get('/orders', 'Api\UserController@orders');
    Route::get('/profile/get', 'Api\UserController@getProfile');
    Route::post('/profile/save', 'Api\UserController@saveProfile');
});

Route::get('success',function(){
    return '';
});

Route::get('failure',function(){
    return '';
});