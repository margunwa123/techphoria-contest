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

//$ GLOBAL
Route::post('/notification/{notification}', $baseDir . '\NotificationController@readNotif');
Route::delete('/notification/{notification}', $baseDir . '\NotificationController@destroy');
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
  Route::resource('personal_request', 'PersonalRequestController')->only(['index', 'update', 'create', 'store', 'destroy']);
  // Profile
  Route::resource('profile', 'ProfileController')->only(['show', 'update']);
  // Projects
  Route::resource('project', 'ProjectController')->only(['destroy', 'index']);
  // Requests
  Route::resource('request', 'RequestController')->except(['show', 'edit']);
  // Applied Request accept/reject  
  Route::post('apply_request/{applyRequest}/reject', 'ApplyRequestController@reject')->name('apply_request.reject');
  Route::post('apply_request/{applyRequest}/accept', 'ApplyRequestController@accept')->name('apply_request.accept');
});

// $ CONSULTANT
Route::namespace($baseDir . '\Consultant')->name('consultant.')->prefix('consultant')->group(function () {
  // Home
  Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
  // Personal Request
  Route::resource('personal_request', 'PersonalRequestController')->only(['index']);
  Route::post('personal_request/{personalRequest}/accept', 'PersonalRequestController@accept')->name('personal_request.accept');
  Route::delete('personal_request/{personalRequest}/reject', 'PersonalRequestController@reject')->name('personal_request.reject');
  // Profile
  Route::resource('profile', 'ProfileController')->only(['show', 'update']);
  // Projects
  Route::resource('project', 'ProjectController')->only(['index', 'destroy']);
  Route::post('project/{project}/cancel', 'ProjectController@cancel')->name('project.cancel');
  // Requests
  Route::resource('request', 'RequestController')->only(['index']);
  // Apply Request
  Route::resource('apply_request', 'ApplyRequestController')->only(['index', 'store', 'destroy']);
  // Finance type
  Route::get('finance_type/edit', 'FinanceTypeController@edit')->name('finance_type.edit');
  Route::put('finance_type', 'FinanceTypeController@update')->name('finance_type.update');
  // Consultant Rating
  Route::resource('consultant_rating', 'ConsultantRatingController')->only('update');
});

Auth::routes();
