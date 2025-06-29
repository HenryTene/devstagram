<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log; // Importante para registrar errores


class PostController extends Controller
{
    use AuthorizesRequests;
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);
        return view('dashboard',[
            'user' => $user,
            'posts' => $posts,
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

        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required', // Validación de imagen
        ]);

        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
        ]);
        return redirect()->route('posts.index',Auth::user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show',[
            'post' => $post,
            'user' => $user,

        ]);
    }




    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        try {
            $post->delete();

            // Eliminar la imagen asociada si existe
           $imagen_path = public_path('uploads/' . $post->imagen);
           if(File::exists($imagen_path)) {
               unlink($imagen_path); // Elimina el archivo de imagen

           }

            return redirect()
                ->route('posts.index', Auth::user()->username)
                ->with('mensaje', 'Post eliminado correctamente');

        } catch (\Exception $e) {
            Log::error('Error al eliminar post: ' . $e->getMessage());

            return back()->with('mensaje_error', 'No se pudo eliminar el post.');
        }
    }




}
