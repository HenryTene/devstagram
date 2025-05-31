<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Routing\Controller;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        //dd(Auth::user());
        return view('dashboard',[
            'user' => $user,
        ]);
    }

    public function create()
    {
        return view('posts.create',[
            'user' => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        //dd('Creando publicacion');
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required|image|max:2048', // Validación de imagen
        ]);
    }
}
