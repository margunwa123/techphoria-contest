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

Route::namespace($baseDir . '\Client')->name('client.')->group(function() {
  // Projects
  Route::resource('project','ProjectController')->except('create', 'store', 'edit', 'update ');
  // Requests
  Route::resource('request','RequestController');
});

Auth::routes();
