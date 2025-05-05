<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RegisterController extends Controller
{
    use ValidatesRequests;
    //
    public  function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {


        // Validate the request data
        $this->validate($request, [
            'name' => 'required|unique:users|max:30',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
    }
}
