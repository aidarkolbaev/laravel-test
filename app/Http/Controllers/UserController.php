<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Show login form
     *
     * @return View
     */
    public function login()
    {
        return view('login');
    }
}
