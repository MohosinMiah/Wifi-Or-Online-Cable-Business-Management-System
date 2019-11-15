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



// Customer Start *****************************

 Route::get('/admin/customer/list','CustomerController@index')->name('customer_list');

 Route::get('/admin/customer/create','CustomerController@create')->name('customer_create');

 Route::post('/admin/customer/post','CustomerController@store')->name('customer_save');

 Route::get('/admin/customer/edit/{id}','CustomerController@edit')->name('customer_edit');

 Route::post('/admin/customer/update/{id}','CustomerController@update')->name('customer_update');

 Route::get('/admin/customer/delete/{id}','CustomerController@destroy')->name('customer_delete');

 Route::get('/admin/customer/search','CustomerController@search_customer')->name("search_customer");

 Route::get('/admin/customer/search/customer','CustomerController@search')->name("search");


//Customer End ********************************




// Payment Start *****************************

Route::get('/admin/payment/history','PaymentController@index')->name('payment_list');

Route::get('/admin/payment/cust/{id}','PaymentController@customerandpaymentajax')->name('payment_customer');

Route::post('/admin/monthly/report/post','PaymentController@monthly_report')->name('monthly_report');

Route::get('/admin/monthly/report','PaymentController@monthly_payment')->name('payment_monthly');

Route::get('/admin/payment/create','PaymentController@create')->name('payment_create');

Route::post('/admin/payment/post','PaymentController@store')->name('payment_save');

Route::get('/admin/payment/view/{id}','PaymentController@show')->name('payment_view');


//Payment End ********************************


// Router Start *************************************


Route::get('/admin/router/add','RoterController@create')->name('router_create');

Route::get('/admin/router/list','RoterController@index')->name('router_list');

Route::get('/admin/router/edit/{id}','RoterController@edit')->name('router_edit');

Route::post('/admin/router/update/{id}','RoterController@update')->name('router_update');

Route::get('/admin/router/delete/{id}','RoterController@destroy')->name('router_delete');

Route::post('/admin/router/save','RoterController@store')->name('router_save');



//Router End **********************************


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/admin/user/list', 'HomeController@user_list')->name("user_list");
Route::get('/admin/user/delete/{id}', 'HomeController@user_delete')->name("user_delete");

