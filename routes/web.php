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

Route::get('/', 'SjabloonController@index');

Route::resource('sjabloon', 'SjabloonController');

Route::get('onderdelen/paginas/{sjabloon_id}', 'OnderdeelController@paginas');
Route::get('onderdelen/children/{parent_id}', 'OnderdeelController@children');
Route::get('onderdelen/create/{onderdeel_id}', 'OnderdeelController@create');
Route::get('onderdelen/delete/{onderdeel_id}', 'OnderdeelController@delete');