<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function index()
    {
        return view('app');
    }

    public function loginForm(): View
    {
        return view('login.login');
    }

    public function registerForm(): View
    {
        return view('login.register');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if(Auth::attempt($credentials, true)) {
            $request->session()->regenerate();

            $user = Auth::getProvider()->retrieveByCredentials($credentials);

            if($user){
                Auth::login($user);

                return redirect(route('parser.parserForm'));
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register(RegisterRequest $request)
    {
        User::create($request->validated());

        return redirect(route('parser.parserForm'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $session = $request->session();

        $session->invalidate();
        $session->regenerateToken();

        return redirect(route('home'));
    }


}
