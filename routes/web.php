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

Route::get('/', 'Pages@home');
Route::get('/login', function(){return view('login');});
Route::get('/admin', 'Pages@admin');
Route::get('/content-management', 'Pages@contentManagement');
Route::get('/user', 'Pages@user');
Route::get('/welcome', 'Pages@welcome');
Route::get('/logout', 'Pages@logout');
Route::post('/login', 'Pages@userLogin');
