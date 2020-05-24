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

Route::get('/login', 'UserController@login');
Route::post('/login', 'UserController@login');
Route::get('/register', 'UserController@create');
Route::post('/register', 'UserController@store');

Route::get('/', 'ArticleController@index');
Route::post('/article', 'ArticleController@create');
Route::get('/article/{id}', 'ArticleController@show');
Route::post('/article/{id}', 'ArticleController@update');
