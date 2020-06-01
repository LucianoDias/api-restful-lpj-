<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Gourp of Usrs
Route::namespace('Api')->name('api')->group(function(){
    Route::prefix('users')->group(function(){
        Route::get('/', 'UserController@index')->name('index_users');
        Route::get('/{id}', 'UserController@show')->name('show_users')->where('id','[0-9]+');
        Route::post('/', 'UserController@store')->name('store_users');
        Route::put('/{id}', 'UserController@update')->name('update_users')->where('id','[0-9]+');
        Route::delete('/{id}', 'UserController@delete')->name('delete_users')->where('id','[0-9]+');
        Route::post('/login','UserController@login')->name('login_users');
    });
});

// Group of Products
Route::namespace('Api')->name('api')->group(function(){
    Route::prefix('products')->group(function(){
        Route::get('/', 'ProductController@index')->name('index_products');
        Route::get('/{id}', 'ProductController@show')->name('show_products')->where('id','[0-9]+');
        Route::post('/', 'ProductController@store')->name('store_products');
        Route::put('/{id}', 'ProductController@update')->name('update_products')->where('id','[0-9]+');
        Route::delete('/{id}', 'ProductController@delete')->name('delete_products')->where('id','[0-9]+');
        
    });
});
