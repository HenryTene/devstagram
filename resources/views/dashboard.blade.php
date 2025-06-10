@extends('layouts.app')

@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
<div class="flex justify-center">
    <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
        <div class="w-8/12 lg:w-6/12 px-5 ">
            <img src="{{ asset('img/usuario.svg' ) }}" alt="imagen de usuario">
        </div>
        <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center  md:items-start py-10">
            <p class="text-gray-700 text-2xl">
                 {{$user->username}}
            </p>
            <p class="text-gray-700 text-sm mb-3 font-bold mt-5">
                0
                <span class="font-normal">Seguidores: </span>
            </p>
            <p class="text-gray-700 text-sm mb-3 font-bold">
                0
                <span class="font-normal">Siguiendo </span>
            </p>
            <p class="text-gray-700 text-sm mb-3 font-bold">
                0
                <span class="font-normal">Posts </span>
            </p>
        </div>
    </div>
</div>

<section class="container mx-auto mt-10">
    <h2 class="text-2xl text-center font-bold mt-10 mb-5">Publicaciones</h2>

    @if ($posts->count())

        <p class="text-center text-gray-500 mb-5">Total de publicaciones: {{ $posts->count() }}</p>

         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($posts as $post)
            <div class="bg-white p-4 rounded-lg shadow-md">
                <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Post Image" class="w-full h-48 object-cover rounded-lg mb-4">
                <h3 class="text-lg font-semibold mb-2">{{ $post->titulo }}</h3>
                <p class="text-gray-600">{{ Str::limit($post->descripcion, 100) }}</p>
            </div>
        @endforeach
            </div>
    @else
        <p class="text-gray-600  uppercase text-sm text-center font-bold">No hay publicaciones disponibles.</p>
    @endif



    </h2>
</section>

@endsection
