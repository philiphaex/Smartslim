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


//Auth routes
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

//Subscription
Route::post('/subscribe/payment', 'SubscribeController@subscribe');
//Betaling per factuur
Route::post('/invoice', 'SubscribeController@invoice');
Route::get('/invoice/success', 'SubscribeController@completeInvoice');
Route::post('/invoice/success', 'SubscribeController@completeInvoice');
//Online betaling
Route::post('/banktransfer', 'SubscribeController@banktransfer');
Route::post('/banktransfer/success','SubscribeController@webhookBanktransfer');
Route::get('/banktransfer/success','SubscribeController@webhookBanktransfer');
Route::get('/banktransfer/complete/{id}','SubscribeController@completeBanktransfer');
//Gratis formule
Route::post('/subscribe/free','SubscribeController@free');


//Email
Route::get('register/verify/{token}','Auth\RegisterController@verify');

//Index
Route::get('/','IndexController@index');
//Contact form
Route::post('/send/contact','IndexController@contact');
//Cookie
Route::get('/privacy/accept','IndexController@acceptCookie');
Route::get('/privacy','IndexController@privacy');
//Logged in
//Route::get('/dashboard', 'AppController@index');
Route::get('/clients',['middleware' => ['role:dietician'], 'uses' => 'ClientController@index']);
//Settings
Route::get('/settings',['middleware' => ['role:dietician'], 'uses' =>'AppController@settings']);
Route::post('/settings/update/user/{id}',['middleware' => ['role:dietician'], 'uses' =>'AppController@updateUser']);
Route::post('/settings/update/business/{id}',['middleware' => ['role:dietician'], 'uses' =>'AppController@updateBusiness']);
//Help form
Route::post('/send/help','IndexController@help');


//Visits
Route::get('/clients/{client_id}/visits/create','VisitController@create');
Route::post('/clients/{client_id}/visits/store/{visit_code}','VisitController@store');
Route::post('/visits/show/{visit_code}','VisitController@show');

//Delete visit from client profile (Ajax Call)
Route::post('clients/visits/delete',['middleware' => ['role:dietician'], 'uses' =>'VisitController@destroy']);

//Add item to visit (Ajax Calls)
Route::post('clients/{client_id}/visits/items/store',['middleware' => ['role:dietician'], 'uses' =>'ItemController@store']);
Route::post('clients/{client_id}/visits/items/edit',['middleware' => ['role:dietician'], 'uses' =>'ItemController@edit']);
Route::post('clients/{client_id}/visits/items/delete',['middleware' => ['role:dietician'], 'uses' =>'ItemController@destroy']);


//Client CRUD
Route::resource('clients', 'ClientController');
Route::post('clients/search', ['middleware' => ['role:dietician'], 'uses' => 'ClientController@search']);

//Accounts
route::resource('accounts','UserController');
route::post('accounts/confirm',['middleware' => ['role:admin'], 'uses' => 'UserController@confirm']);
Route::post('accounts/search', ['middleware' => ['role:admin'], 'uses' => 'UserController@search']);
Route::post('accounts/all', ['middleware' => ['role:admin'], 'uses' => 'UserController@all']);


//Orders
route::get('orders', ['middleware' => ['role:admin'], 'uses' => 'OrderController@index']);
route::post('orders/confirm', ['middleware' => ['role:admin'], 'uses' => 'OrderController@confirm']);
route::get('orders/edit/{id}',['middleware' => ['role:admin'], 'uses' => 'OrderController@edit']);
route::post('orders/update/{id}',['middleware' => ['role:admin'], 'uses' => 'OrderController@update']);

//Dashboard
Route::get('/dashboard', ['middleware' => ['role:dietician'], 'uses' => 'AppController@index']);
Route::get('/admin/dashboard', ['middleware' => ['role:admin'], 'uses' => 'AdminController@index']);

//Admin registratie
Route::get('/admin','AdminController@register');
Route::post('/admin/create','AdminController@create');

