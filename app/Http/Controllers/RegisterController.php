<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public  function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //dd($request);
        dd($request->get('name'));
        dd($request->get('email'));
        dd($request->get('password'));
        dd($request->get('password_confirmation'));
        // dd($request->all());
    }
}
