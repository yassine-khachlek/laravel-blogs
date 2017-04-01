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

Route::group(['prefix' => 'blog', 'as' => 'blogs.'], function () {

	Route::get('/', 'BlogsController@index')->name('index');

	Route::get('/create', 'BlogsController@create')->name('create');

	Route::post('/', 'BlogsController@store')->name('store');

	Route::get('/{id}/edit', 'BlogsController@edit')->name('edit');

	Route::patch('/{id}', 'BlogsController@update')->name('update');

	Route::get('/{id}', 'BlogsController@show')->name('show');

	Route::delete('/{id}', 'BlogsController@destroy')->name('destroy');

});
