<?php

use Illuminate\Http\Request;


//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'ApiController\AuthController@login');
    Route::post('signup', 'ApiController\AuthController@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'ApiController\AuthController@logout');
        Route::get('user', 'ApiController\AuthController@user');
    });
});
Route::apiResource("/products",'ApiController\ProductController');


Route::group(['prefix'=>'products'],function (){
    Route::apiResource("/{product}/reviews",'ApiController\ReviewController');



});;
