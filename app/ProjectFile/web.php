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


//Route::get('/index', 'UserController@index')->name('index');

//  Route::get ( '/print', function () {
// 	return view ( 'print.print' );
// } );
Auth::routes();

//Route::get('/', 'HomeController@index')->name('home');
Route::post('/store', 'HomeController@store')->name('store');

Route::get('/create', 'HomeController@create');
Route::get('/', 'HomeController@sidebar');

//Route::post('/login', 'UserController@login');
//Route::post('/register', 'UserController@register');
//Route::get('/logout', 'UserController@logout');

Route::get('menu/index', 'MenuController@index');
//Route::get('/', 'HomeController@index1');
Route::get('menu/create', 'MenuController@create');
Route::post('menu/store', 'MenuController@store')->name('store');


Route::get('site/index', 'SiteController@index');
Route::get('worker', 'WorkerController@index');

Route::get('/search','ApplicantController@search')->name('search');
Route::post('/store/{serial_no}','ApplicantController@store')->name('search.store');

Route::get('/print', 'PrintController@index')->name('print');


// Route::get('login', 'UserController@showLogin');

// // route to process the form

// Route::post('/login',  'UserController@doLogin')->name('login');

// Route::get('logout',  'UserController@doLogout')->name('logout');

// Route::get('/',
// function ()
// 	{
// 	return view('auth.login');
// 	});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

//  Route::get('/home', 'HomeController@index')->name('home');
