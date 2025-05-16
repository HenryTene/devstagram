<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use ValidatesRequests;
    //
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            // Si falla, redirige con error
            return back()->with('mensaje', 'Credenciales incorrectas');
        } else {
            // Si tiene éxito, redirige al home
            return redirect()->route('posts.index')->with('status', 'Bienvenido');
        }
    }
}
