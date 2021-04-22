<?php

Route::group(['middleware' => 'auth:api' ,
'namespace' => 'App\Http\Controllers',],
 function () {
    Route::get('profile',   'AuthController@userProfile');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');    
    Route::post('ResetPassword','ResetPasswordController@sendEmail');
    Route::post('changepassword','ChangePasswordController@process');
    //product crud 
    Route::get('productlist','ProductController@list');
    Route::get('product/{id}','ProductController@getProductById');
    Route::post('add','ProductController@create');
    Route::put('edit/{id}','ProductController@edit');
    Route::delete('delete/{id}','ProductController@destroy');
    //edit user 
    Route::put('editUser/{id}','UserController@editUser');
    // get a specific user 
    Route::get('user/{id}','UserController@UserById');
    
   
});
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers'
    

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    



});