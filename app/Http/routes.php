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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('flipkart', 'FindPriceController@flipkart');
//Route::get('amazon', 'FindPriceController@amazon');
//Route::get('snapdeal', 'FindPriceController@snapdeal');
//Route::get('printvenue', 'FindPriceController@printvenue');
//Route::get('paytm', 'FindPriceController@paytm');
//Route::get('shopclues', 'FindPriceController@shopclues');
//Route::get('ebay', 'FindPriceController@ebay');
//Route::get('mobilestore', 'FindPriceController@mobilestore');
//Route::get('shopmonk', 'FindPriceController@shopmonk');
//Route::get('croma', 'FindPriceController@croma');
//Route::get('/', ['as'=>'index','uses'=>'FindPriceController@index']);
Route::group(['middleware' => 'guest'], function()
{
   Route::get('/',['as' => 'login','uses' => 'LoginController@getHome']);
   Route::get('login/{provider?}', ['as' => 'social','uses' => 'SocialiteController@login']);
   Route::get('sign-in',['as' => 'login','uses' => 'LoginController@getLogin']);
   Route::get('register',['as' => 'register','uses' => 'LoginController@getRegister']);
   Route::post('register',['as' => 'post:register','uses' => 'LoginController@postRegister']);
   Route::post('login',['as' => 'post:login','uses' => 'LoginController@postLogin']);

//   Route::get('password/email', ['as' => 'reset', 'uses' =>'Auth\PasswordController@getEmail']);
   Route::post('password/email', ['as' => 'resetPassword', 'uses' => 'Auth\PasswordController@postEmail']);
   Route::get('password/reset/{token}', ['as' => 'forgotPassword', 'uses' => 'Auth\PasswordController@getReset']);
   Route::post('password/reset', ['as' => 'post:reset-password', 'uses' => 'Auth\PasswordController@postReset']);
});

Route::group(['middleware' => 'auth'], function() {
   Route::post('findprice', array('as' => 'findprice', 'uses' => 'FindPriceController@findprice'));
   Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
   Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'FindPriceController@getDashboard']);
   Route::get('target-price/{id}', ['as' => 'target-price', 'uses' => 'FindPriceController@getTargetPricePage']);
   Route::post('target-price/{id}', ['as' => 'post:target-price', 'uses' => 'FindPriceController@postTargetPricePage']);
   Route::get('your-products', ['as' => 'your-products', 'uses' => 'FindPriceController@getYourProducts']);

   Route::get('dashboard-new', ['as' => 'dashboard-new', 'uses' => 'FindPriceController@getDashboardNew']);
   Route::get('user-profile', ['as' => 'user-profile', 'uses' => 'FindPriceController@getUserProfile']);
   Route::post('user-profile-update', ['as' => 'post:user-profile-update', 'uses' => 'FindPriceController@postUserProfileUpdate']);

   Route::get('update-your-products', ['as' => 'update-your-products', 'uses' => 'FindPriceController@getUpdateYourProducts']);
   Route::get('edit-target-price/{id}', ['as' => 'edit-target-price', 'uses' => 'FindPriceController@editTargetPrice']);
   Route::post('update-target-price/{id}', ['as' => 'post:update-target-price', 'uses' => 'FindPriceController@postUpdateTargetPrice']);
   Route::get('delete-your-products/{id}', ['as' => 'delete-your-products', 'uses' => 'FindPriceController@deleteYourProducts']);

   Route::get('add-your-profile', ['as' => 'add-your-profile', 'uses' => 'FindPriceController@addYourProfile']);
   Route::post('add-your-profile', ['as' => 'post:add-your-profile', 'uses' => 'FindPriceController@postAddYourProfile']);
   Route::get('add-profile-image', ['as' => 'add-profile-image', 'uses' => 'FindPriceController@getAddYourImage']);
   Route::get('edit-profile-image', ['as' => 'edit-profile-image', 'uses' => 'FindPriceController@getEditYourImage']);
   Route::post('edit-profile-image', ['as' => 'post:edit-profile-image', 'uses' => 'FindPriceController@postEditYourImage']);

   Route::get('deactivate-account', ['as' => 'deactivate-account', 'uses' => 'FindPriceController@deactivateAccount']);

});


