<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('member/books', 'Member\\BooksController');
Route::resource('users', 'UserController');


// Users route

Route::get('/home', ['uses' => 'UserController@getHome']);
Route::controller('/user', 'Auth\AuthController');
Route::controller('/password', 'Auth\PasswordController');
 
// Admin route
Route::get('/admin/home', ['uses' => 'AdminController@getHome']);
Route::controller('/admin', 'Auth\AdminAuthController');
Route::controller('/admin/password', 'Auth\AdminPasswordController');


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');


// Authentication routes...
Route::get('adminauth/login', 'Auth\AdminAuthController@getLogin');
Route::post('adminauth/login', 'Auth\AdminAuthController@postLogin');
Route::get('adminauth/logout', 'Auth\AdminAuthController@getLogout');

// Registration routes...
Route::get('adminauth/register', 'Auth\AdminAuthController@getRegister');
Route::post('adminauth/register', 'Auth\AdminAuthController@postRegister');