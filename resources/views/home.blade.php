@extends('layouts.app')

@section('titulo')

Página Principal Home

@endsection


@section('contenido')


    {{-- @if ($posts->count())

         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <a href="{{ route('posts.show', ['post'=> $post, 'user'=>$post->user]) }}" class="block mb-4">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Post Image" class="w-full h-48 object-cover rounded-lg mb-4">
                    </a>
                    <h3 class="text-lg font-semibold mb-2">{{ $post->titulo }}</h3>

                </div>
            @endforeach
        </div>

        <div class="my-10">
            {{ $posts->links() }}
        </div>

    @else

        <p class="text-center text-2xl md:text-3xl lg:text-4xl font-bold text-gray-800 md:text-white">
            No hay posts, sigue a alguien para poder mostrar sus posts
        </p>


    @endif --}}
    <x-listar-post />


@endsection
