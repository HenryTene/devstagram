@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection
@section('contenido')

    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Post Image" class="w-full h-96 object-cover rounded-lg mb-4">
            <div class="p-3">
                <p>0 likes</p>
            </div>
            <div >
                <p class="font-bold">{{$post->user->username}}</p>
                <p>{{$post->created_at->diffForHumans()}}</p>
                <p class="mt-5">{{ $post->descripcion }} </p>
            </div>

        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white  rounded-lg p-5 mb-6">
                @auth
                <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>
                <form action="{{route('comentarios.store',['post'=>$post, 'user'=>$user])}}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                            Añade un comentario
                        </label>
                        <textarea
                                id="comentario"
                                name="comentario"
                                placeholder="Agrega un comentario"
                                class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                        ></textarea>
                        @error('comentario')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                    <input
                        type="submit"
                        value="Comentar"
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg mt-5"
                    />
                </form>
                @endauth
            </div>

        </div>

    </div>

@endsection
