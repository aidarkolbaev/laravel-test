<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Show login form
     *
     * @param Request $request
     * @return RedirectResponse|Redirector|View
     */
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'username' => 'required|max:50',
                'password' => 'required|max:50'
            ]);
            if (Auth::attempt($data)) {
                return redirect()->intended();
            }
            return view('login')->withErrors(['invalid_auth' => 'Неправильный логин или пароль']);
        }
        return view('login');
    }

    /**
     * Show register form
     *
     * @param Request $request
     * @return RedirectResponse|Redirector|View
     */
    public function register(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'username' => 'required|max:50',
                'password' => 'required|max:50'
            ]);
            $data['password'] = Hash::make($data['password']);
            $user = new User($data);
            $user->save();
            return redirect('/login');
        }
        return view('register');
    }

    /**
     * Logout user
     */
    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
