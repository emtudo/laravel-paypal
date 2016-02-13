<?php

/*
|--------------------------------------------------------------------------
! Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', 'DonativoController@index');
Route::post('/doar', 'DonativoController@store');
Route::get('/cancel', 'DonativoController@cancel');

Route::post('/contacts', 'ContactController@store');
