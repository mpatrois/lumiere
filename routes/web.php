<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::prefix('api')->group(function () {
    
    Auth::routes();
    
    Route::get('/user', function () {
        return Auth::user();
    });
    Route::get('/logout', function () {
        Auth::logout();
    });
    
    Route::get('video/play/{id}', 'VideoController@play');
    Route::resource('video', 'VideoController');
    Route::get('video/{id}', 'VideoController@show');

});



Route::get('{any}', function () {
    return File::get(public_path() . '/index.html');
})->where('any', '.*');;