<?php



Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('ResetPassword','ResetPasswordController@sendEmail');
    Route::post('changepassword','ChangePasswordController@process');

    Router::get('prodct','ProductController@getProduct');



});