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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('prepaid-balance', [
        'uses' => 'PrepaidBalanceController@create',
        'as' => 'create.prepaid-balance',
    ]);

    Route::post('prepaid-balance', [
        'uses' => 'PrepaidBalanceController@store',
        'as' => 'store.prepaid-balance',
    ]);

    Route::get('product', [
        'uses' => 'ProductController@create',
        'as' => 'create.order-product',
    ]);

    Route::post('product', [
        'uses' => 'ProductController@store',
        'as' => 'store.order-product',
    ]);

    Route::get('payment', [
        'uses' => 'PaymentController@create',
        'as' => 'create.payment',
    ]);

    Route::post('payment', [
        'uses' => 'Paymentcontroller@store',
        'as' => 'store.payment',
    ]);


    Route::get('order', [
        'uses' => 'OrderController@index',
        'as' => 'index.order',
    ]);
});

// Route::get('/home', 'HomeController@index')->name('home');
