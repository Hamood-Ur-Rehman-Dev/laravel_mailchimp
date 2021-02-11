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

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/subscribe','HomeController@subscribe')->name('subscribe');
Route::post('/unSubscribe','HomeController@unSubscribe')->name('unSubscribe');

Route::get('/emails-to-subscribers','HomeController@sendEmails')->name('send.emails');

Route::get('/mailchimp','HomeController@mailChimp')->name('mailchimp');
