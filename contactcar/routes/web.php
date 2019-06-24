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
});

Route::resource('auth','AuthController');
Route::post('/auth/login','AuthController@login');

Route::resource('sale', 'SaleController');

Route::post('picture/{postId}', 'PictureController@store');
Route::get('picture', 'PictureController@index');

Route::resource('comment', 'CommentController');
