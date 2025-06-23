<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)

    {

        //Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);
        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' . Auth::user()->id, 'min:3', 'max:20', 'not_in:devstagram, twitter, facebook, instagram, youtube, linkedin,editar_perfil'],
        ]);

        if ($request->imagen) {


            $manager = new ImageManager(new Driver());
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();
            $imagenServidor = $manager->read($imagen);
            $imagenServidor->scale(1000, 1000);
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        //Guardar cambios
        $usuario = User::find(Auth::user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? $usuario->imagen; // Si no hay imagen, mantener la existente
        $usuario->save();

        //Redireccionar
        return redirect()->route('posts.index', $usuario->username)->with('mensaje', 'Perfil actualizado correctamente');
    }
}
