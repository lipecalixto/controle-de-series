<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    public function index()
    {
        return view('login.index');
    }

    public function store(Request $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->back()->withErrors('Usuário ou senha inválidos');
        }

        return to_route('series.index');
    }

    public function destroy()
    {
        Auth::logout();

        return to_route('login');
    }

    public function loginApi(Request $request)
    {
        $credentials = $request->only(['email','password']);
        
        if(Auth::attempt($credentials) === false){
            return response()->json('Unauthorized',401);
        }

        $user = Auth::user();
        $token = $user->createToken('token');
        
        return response()->json($token->plainTextToken);

    }
}
