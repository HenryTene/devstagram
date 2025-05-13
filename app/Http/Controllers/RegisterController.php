<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;

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
            'username'=> 'required|unique:users|min:3|max:20',
            'email' => 'required|email|unique:users|max:60',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
}
