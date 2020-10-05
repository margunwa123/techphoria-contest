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


$baseDir = "App\Http\Controllers";

Route::get('/', function () {
  return view('welcome');
});

Route::namespace($baseDir . '\Client')->name('client.')->group(function () {
  // Home
  Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
  // Company
  Route::resource('company', 'CompanyController')->except('show');
  // Consultant
  Route::get('/consultant', 'ConsultantController@index')->name('consultant.index');
  // Personal Request
  Route::resource('personal_request', 'PersonalRequestController')->except('show');
  // Profile
  Route::resource('profile', 'ProfileController')->only(['edit', 'update', 'show']);
  // Projects
  Route::resource('project', 'ProjectController')->only(['index']);
  // Requests
  Route::resource('request', 'RequestController');
});

Route::namespace($baseDir . '\Consultant')->name('consultant.')->prefix('consultant')->group(function () {
  // Home
  Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
  // Personal Request
  Route::resource('personal_request', 'PersonalRequestController')->only(['index']);
  Route::post('personal_request/accept', 'PersonalRequestController@accept')->name('personal_request.accept');
  Route::post('personal_request/reject', 'PersonalRequestController@reject')->name('personal_request.accept');
  // Profile
  Route::resource('profile', 'ProfileController')->only(['edit', 'update', 'show']);
  // Projects
  Route::resource('project', 'ProjectController')->only(['index', 'destroy']);
  // Requests
  Route::resource('request', 'RequestController')->only(['index']);
  Route::post('request/accept', 'RequestController@accept')->name('request.accept');
  Route::post('request/reject', 'RequestController@reject')->name('request.reject');;
});

Auth::routes();
