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
// Dashboar
// Route::get('dasboard', 'DashboardController@index')->name('dashboard');

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
Route::get('/home', function(){
    return view('home');
});


Route::get('activity', 'DashboardController@activity')->name('activity.index');

// App
Route::get('/', 'BinaanController@index')->name('dashboard');
Route::get('/index/1', 'HomeController@index')->name('index');
Route::get('/index/2', 'HomeController@index2')->name('index2');
Route::get('/index/3', 'HomeController@index3')->name('index3');

Route::get('/widgets', 'HomeController@widgets')->name('widgets');

Route::get('/layout/top-nav', 'HomeController@topNav')->name('layout.top-nav');
Route::get('/layout/boxed', 'HomeController@boxed')->name('layout.boxed');
Route::get('/layout/fixed', 'HomeController@fixed')->name('layout.fixed');
Route::get('/layout/fixed-topnav', 'HomeController@fixedTopnav')->name('layout.fixed-topnav');
Route::get('/layout/fixed-footer', 'HomeController@fixedFooter')->name('layout.fixed-footer');
Route::get('/layout/collapsed-sidebar', 'HomeController@collapsedSidebar')->name('layout.collapsed-sidebar');

Route::get('/charts/chartjs', 'HomeController@chartjs')->name('charts.chartjs');
Route::get('/charts/flot', 'HomeController@flot')->name('charts.flot');
Route::get('/charts/inline', 'HomeController@inline')->name('charts.inline');

Route::get('/ui/general', 'HomeController@uiGeneral')->name('ui.general');
Route::get('/ui/icons', 'HomeController@icons')->name('ui.icons');
Route::get('/ui/buttons', 'HomeController@buttons')->name('ui.buttons');
Route::get('/ui/sliders', 'HomeController@sliders')->name('ui.sliders');
Route::get('/ui/modals', 'HomeController@modals')->name('ui.modals');

Route::get('/forms/general', 'HomeController@formsGeneral')->name('forms.general');
Route::get('/forms/advanced', 'HomeController@advanced')->name('forms.advanced');
Route::get('/forms/editors', 'HomeController@editors')->name('forms.editors');

Route::get('/tables/simple', 'HomeController@simple')->name('tables.simple');
Route::get('/tables/data', 'HomeController@data')->name('tables.data');

Route::get('/calendar', 'HomeController@calendar')->name('calendar');

Route::get('/mailbox/mailbox', 'HomeController@mailbox')->name('mailbox.mailbox');
Route::get('/mailbox/compose', 'HomeController@compose')->name('mailbox.compose');
Route::get('/mailbox/read-mail', 'HomeController@readMail')->name('mailbox.read-mail');

Route::get('/examples/invoice', 'HomeController@invoice')->name('examples.invoice');
Route::get('/examples/invoice-print', 'HomeController@invoicePrint')->name('examples.invoice-print');
Route::get('/examples/profile', 'HomeController@profile')->name('examples.profile');
Route::get('/examples/login', 'HomeController@login')->name('examples.login');
Route::get('/examples/register', 'HomeController@register')->name('examples.register');
Route::get('/examples/lockscreen', 'HomeController@lockscreen')->name('examples.lockscreen');

Route::get('/extra/404', 'HomeController@page404')->name('extra.404');
Route::get('/extra/500', 'HomeController@page500')->name('extra.500');
Route::get('/extra/blank', 'HomeController@blank')->name('extra.blank');
Route::get('/extra/legacy-user-menu', 'HomeController@legacyUserMenu')->name('extra.legacy-user-menu');
Route::get('/extra/starter', 'HomeController@starter')->name('extra.starter');