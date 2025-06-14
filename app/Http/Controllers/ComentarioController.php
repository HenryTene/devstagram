<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        // Validar comentario
        $request->validate([
            'comentario' => 'required|min:5|max:255',
        ]);

       //Almacenar el resultado
       Comentario::create([
           'user_id' => Auth::user()->id,
           'post_id' => $post->id,
           'comentario' => $request->comentario,
       ]);

       //Imprimir un
         return back()->with('mensaje', 'Comentario publicado correctamente');
    }
}
