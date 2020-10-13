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

// Auth
Route::auth();
// App
Route::get('/', 'BinaanController@index')->name('dashboard');
// Profil Admin
Route::get('profile', 'ProfileController@show')->name('profile.show');
Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::put('profile/edit', 'ProfileController@update')->name('profile.update');

// SUPER ADMIN
// Admin
Route::resource('admin', 'AdminController');

// ADMIN
Route::resource('binaan', 'BinaanController');
Route::post('update-proses', 'BinaanController@updateProses')->name('binaan.update-proses');
Route::post('update-proses-petugas', 'BinaanController@updateProsesPetugas')->name('binaan.update-proses-petugas');
Route::get('binaan/{id}/get-data/{$proses_id}/proses', 'BinaanController@getData')->name('binaan.get-data');
Route::get('home', 'BinaanController@home')->name('home');
Route::get('activity', 'DashboardController@activity')->name('activity.index');

