<?php

use Illuminate\Support\Facades\Route;

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
/*
Route::get('/', function () {
    return view('dashboard.index');
});
*/
/*
Route::get('/dashboard', function () {
    return redirect('/index') ;
});
*/
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    //Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/index', function () {
        return view('dashboard.index');
    });

    //users routes
    Route::resource('users', 'UserController')->except(['show']);


    //categories routes
    Route::resource('categories', 'CategoryController')->except(['show']);


    //products routes
    Route::resource('products', 'ProductController');


    //clients routes
    Route::resource('clients', 'ClientController')->except(['show']);
    Route::resource('clients.orders', 'Client\OrderController')->except(['show']);

    //vendors routes
    Route::resource('vendors', 'vendorController')->except(['show']);


    //orders routes
    Route::resource('orders', 'OrderController')->except(['show']);
    Route::get('/orders/{order}/products', 'OrderController@products')->name('orders.products');

    //invoices
    Route::resource('invoices', 'invoiceController');
    Route::get('invoices/{id}/pdf', 'invoiceController@pdf')->name('invoices.pdf');
    Route::get('invoices/{id}/print', 'invoiceController@pdf')->name('invoices.print');


    //bills
    Route::resource('bills', 'billController');
    Route::get('bills/{id}/pdf', 'billController@pdf')->name('bills.pdf');
    Route::get('bills/{id}/print', 'billController@pdf')->name('bills.print');


    //transaction
    // Route::resource('/invoices/transactions', 'TransactionController');
    Route::get('/transactions', 'TransactionController@index')->name('transactions.index');


    // invoices - transaction
    Route::get('/invoices/transactions', 'TransactionController@show')->name('invoices.transactions.index');
    Route::get('/invoices/{id}/transactions', 'TransactionController@show')->name('invoices.transactions.show');
    Route::get('/invoices/{id}/transactions/create', 'TransactionController@create')->name('invoices.transactions.create');
    Route::post('/invoices/{id}/transactions', 'TransactionController@store')->name('invoices.transactions.store');



    // bills - transaction
    Route::get('/invoices/transactions', 'TransactionController@show')->name('invoices.transactions.index');
    Route::get('/bills/{id}/transactions', 'TransactionController@show')->name('bills.transactions.show');  
    Route::get('/bills/{id}/transactions/create', 'TransactionController@create')->name('bills.transactions.create');
    Route::post('/bills/{id}/transactions', 'TransactionController@store')->name('bills.transactions.store');


});

});


//Auth::routes();

