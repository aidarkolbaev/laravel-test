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

Route::match(['get', 'post'], '/login', 'UserController@login');
Route::match(['get', 'post'], '/register', 'UserController@register');

Route::get('/', 'ArticleController@index');
Route::get('/article', 'ArticleController@create');
Route::post('/article', 'ArticleController@store');
Route::get('/article/{id}', 'ArticleController@show');
Route::post('/article/{id}', 'ArticleController@update');
