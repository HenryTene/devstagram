<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

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
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);
     }
}
