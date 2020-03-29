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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => ['auth', 'client']], function(){
	Route::get('/home', 'HomeController@display');
	Route::post('/create', 'HomeController@insert');
	Route::post('/update', 'HomeController@update');
});

Route::group(['middleware' => ['auth', 'admin']], function(){
	Route::get('/admin', 'AdminPageController@display');
	Route::get('/admin/display', 'AdminPageController@display1');
	Route::get('/admin/display_logs', 'AdminPageController@display_logs');
//-----------------------------------------------------------------------
	Route::get('/admin/logs', 'AdminPageController@display_logs1');
//-----------------------------------------------------------------------
	Route::post('/admin/inprogress', 'AdminPageController@status_inprogress');
	Route::get('/admin/inprogress_ticket', 'AdminPageController@display_inprogress_ticket');
	Route::post('/admin/inprogress_to_closed', 'AdminPageController@inprogress_to_closed');
	Route::post('/admin/closed', 'AdminPageController@status_closed');
	Route::get('/admin/closed_ticket', 'AdminPageController@display_closed_ticket');
	Route::post('/admin/closed_to_open', 'AdminPageController@closed_to_open');
});


Route::group(['middleware' => ['auth', 'admin' || 'client']], function(){
	Route::get('/comment_page/{id}', 'comment_section@display');
	Route::post('/comment_page/insert', 'comment_section@insert');
	Route::get('/logs_page/{id}', 'comment_section@display1');
});

