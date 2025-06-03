<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

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
            'imagen' => 'required', // Validación de imagen
        ]);
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => Auth::id(),
        // ]);

        //Otra forma de crear el post
        // $post = new Post();
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = Auth::id();
        // $post->save();

        //Otra forma de crear el post
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
        ]);
        return redirect()->route('posts.index',Auth::user()->username);
    }
}
