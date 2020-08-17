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

// Dashboard Routes
Route::get('/', 'DashboardController@index')->name('dashboard.index')->middleware(['auth', 'check.department']);

// Categories Routes
Route::resource('categories', 'CategoryController')->middleware(['auth', 'check.department']);

// Patron Routes
Route::resource('patrons', 'PatronController')->middleware(['auth', 'check.department']);

// Payment Routes
Route::resource('payments', 'PaymentController')->middleware(['auth', 'check.department']);
Route::patch('payments/{payment}/parcel/{parcel}', 'PaymentController@updateParcel')->middleware(['auth', 'check.department'])->name('payments.parcel.update');
Route::get('payments/recipt/{nome}', 'PaymentController@downloadRecipt')->middleware(['auth', 'check.department'])->name('payments.download.recipt');


// Project Routes
Route::resource('projects', 'ProjectController')->middleware(['auth', 'check.department']);

// Sponsor Routes
Route::resource('sponsors', 'SponsorController')->middleware(['auth', 'check.department']);

// Auth Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('login/{provider}', 'Auth\SocialLoginController@redirectToProvider')->name('socialite.provider');
Route::get('auth/{provider}/callback', 'Auth\SocialLoginController@handleProviderCallback')->name('socialite.callback');
