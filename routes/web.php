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

Route::get('/', function () {
    return view('welcome');
})->name('app.index');

Route::get('cars', 'CarController@index')->name('cars.index');
Route::get('cars/create', 'CarController@create')->name('cars.create');
Route::get('cars/edit/{id}', 'CarController@edit')->name('cars.edit');

Route::get('cars/{id}', 'CarController@show')->name('cars.show');

//Route::resource('cars', 'CarController');
