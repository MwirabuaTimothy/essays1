<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	// return Redirect::to(Config::get('app.url').'/e.html');
	return View::make('index');
});

Route::resource('users', 'UsersController');
// users --fields="fname:string, lname:string, uname:string, email:string, password:string, role:string, country:string, phone_1:string, phone_2:string"
Route::resource('orders', 'OrdersController');
// orders --fields="topic:string, instructions:string, subject:string, doctype:string, pages:string, single_paced:boolean, style:string, academic_level:string, page_cost:string, total:string, currency:string, language:string, urgency:string, recieve_calls:boolean, status:string, notes:string"
Route::resource('uploads', 'UploadsController');
// uploads --fields="url:string, title:string, order_id:string, user_id:string, downloads:integer, category:string"

Route::controller('account', 'AccountController');

Route::get('login', function()
{
	return Redirect::to('account/login');
});
