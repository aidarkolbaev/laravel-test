<?php

use App\User;
use Illuminate\Http\Request;
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

Route::match(['get', 'post'], '/login', 'UserController@login')->name('login');
Route::match(['get', 'post'], '/register', 'UserController@register');
Route::any('/logout', 'UserController@logout')->middleware('auth');

Route::get('/', 'ArticleController@index');
Route::match(['get', 'post'], '/article', 'ArticleController@create')->middleware('auth');
Route::get('/article/{id}', 'ArticleController@show');
Route::match(['get', 'post'], '/article/{id}/edit', 'ArticleController@edit')->middleware('auth');
