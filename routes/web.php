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

Route::get('/', function (Request $request) {
    $page = (int)$request->query('page', 1);
    $limit = 10;
    $offset = ($page - 1) * $limit;
    $usersNum = User::query()->count();
    $users = User::query()->offset($offset)->limit($limit)->get();
    return view('users', ['users' => $users, 'usersNum' => $usersNum]);
});
