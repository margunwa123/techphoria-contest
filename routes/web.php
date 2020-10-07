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

// $ CLIENT
Route::namespace($baseDir . '\Client')->name('client.')->group(function () {
  // Home
  Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
  // Company
  Route::resource('company', 'CompanyController');
  // Consultant
  Route::resource('client/consultant', 'ConsultantController')->only(['index', 'show']);
  // Personal Request
  Route::resource('personal_request', 'PersonalRequestController')->except(['show', 'index']);
  // Profile
  Route::resource('profile', 'ProfileController')->only(['edit', 'update', 'show']);
  // Projects
  Route::resource('project', 'ProjectController')->only(['destroy', 'index']);
  // Requests
  Route::resource('request', 'RequestController')->except(['show', 'edit']);
});

// $ CONSULTANT
Route::namespace($baseDir . '\Consultant')->name('consultant.')->prefix('consultant')->group(function () {
  // Home
  Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
  // Personal Request
  Route::resource('personal_request', 'PersonalRequestController')->only(['index'])->middleware('checkrole:consultant');
  Route::post('personal_request/accept', 'PersonalRequestController@accept')->name('personal_request.accept')->middleware('checkrole:consultant');
  Route::post('personal_request/reject', 'PersonalRequestController@reject')->name('personal_request.accept')->middleware('checkrole:consultant');
  // Profile
  Route::resource('profile', 'ProfileController')->only(['edit', 'update', 'show']);
  // Projects
  Route::resource('project', 'ProjectController')->only(['index', 'destroy']);
  // Requests
  Route::resource('request', 'RequestController')->only(['index']);
  Route::post('request/accept', 'RequestController@accept')->name('request.accept');
  Route::post('request/reject', 'RequestController@reject')->name('request.reject');
  // Apply Request
  Route::resource('apply_request', 'ApplyRequestController')->only(['index', 'store', 'destroy']);
  // Finance type
  Route::get('finance_type/edit', 'FinanceTypeController@edit')->name('finance_type.edit');
  Route::put('finance_type', 'FinanceTypeController@update')->name('finance_type.update');
});

Auth::routes();
