<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        if ($request->routeIs('register.start')) {
            return "Register";
        }

        return view('Auth.login');
    }

    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();

        // Verificamos el Usuario
        if (!auth()->attempt($validatedData)) {
            return to_route('login.start')->with('status', 'Credenciales Incorrectas')->withInput();
        }

        return to_route('home');
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login.start');
    }


    public function register()
    {
    }
}
