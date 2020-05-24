<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
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
            $user = User::query()->where(['username' => $data['username']])->get();
            return redirect('/');
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
            $user = new User($data);
            $user->save();
            return redirect('/');
        }
        return view('register');
    }
}
