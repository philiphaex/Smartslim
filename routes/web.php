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


//Auth::routes();
//Auth routes
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm ')->name('password.reset');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

//Subscription
Route::post('/subscribe/payment', 'SubscribeController@subscribe');

Route::post('/invoice', 'SubscribeController@invoice');
Route::get('/invoice/success', 'SubscribeController@completeInvoice');
Route::post('/invoice/success', 'SubscribeController@completeInvoice');

Route::post('/banktransfer', 'SubscribeController@banktransfer');
Route::post('/banktransfer/success','SubscribeController@webhookBanktransfer');
Route::get('/banktransfer/success','SubscribeController@webhookBanktransfer');
Route::get('/banktransfer/complete/{id}', 'SubscribeController@completeBanktransfer');

//Email
//Route::post('/send', 'EmailController@send');
//Mail confirmation
/*Route::get('/mail',[
    'uses' => 'EmailController@send'
]);*/
//User confirmation from mail
Route::get('register/verify/{token}', 'Auth\RegisterController@verify');

//Front
Route::get('/', 'IndexController@index');

//Logged in
Route::get('/dashboard', 'AppController@index');
Route::get('/clients', 'ClientController@index');
//Visits
Route::get('/clients/{client_id}/visits/create','VisitController@create');
Route::post('/clients/{client_id}/visits/store/{visit_code}','VisitController@store');
Route::post('/visits/show/{visit_code}','VisitController@show');

//Delete visit from client profile (Ajax Call)
//Route::delete('/visits/delete/{visit_code}','VisitController@destroy');
Route::post('clients/visits/delete','VisitController@destroy');

//Add item to visit (Ajax Calls)
Route::post('clients/{client_id}/visits/items/store','ItemController@store');
Route::post('clients/{client_id}/visits/items/edit','ItemController@edit');
Route::post('clients/{client_id}/visits/items/delete','ItemController@destroy');


//Client CRUD
Route::resource('clients', 'ClientController');
Route::post('clients/search','ClientController@search');

//Accounts
route::resource('accounts','UserController');
route::post('accounts/confirm','UserController@confirm');

//Orders
route::get('orders','OrderController@index');
route::post('orders/confirm','OrderController@confirm');

//Roles - Permissions
Route::get('/dashboard', ['middleware' => ['role:admin'], 'uses' => 'AppController@index_admin']);
Route::get('/dashboard', ['middleware' => ['role:dietician'], 'uses' => 'AppController@index_dietician']);

