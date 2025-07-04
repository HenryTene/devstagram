@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection
@section('contenido')

    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Post Image" class="w-full h-96 object-cover rounded-lg mb-4">

                <div class="p-3 flex items-center gap-4">
                    @auth
                        <livewire:like-post :post="$post" />
                    @endauth

                    <p class="inline-flex items-center bg-gray-100 px-3 py-1 rounded-full text-sm shadow-sm">
                        <span class="text-pink-600 font-bold mr-1">{{ $post->likes->count() }}</span>
                        <span class="text-gray-600">likes</span>
                    </p>

                </div>

                <div >
                    <p class="font-bold">{{$post->user->username}}</p>
                    <p>{{$post->created_at->diffForHumans()}}</p>
                    <p class="mt-5">{{ $post->descripcion }} </p>
                </div>

                    @auth
                        @if ($post->user_id === auth()->user()->id)
                            <form action="{{route('posts.destroy', $post)}}" method="POST" class="mt-5">
                                @method('DELETE')
                                @csrf
                                <input
                                        type ="submit"
                                        value="Eliminar publicación"
                                        class="bg-red-500 hover:bg-red-600 transition-colors cursor-pointer uppercase font-bold p-3 text-white rounded-lg mt-5"
                                    >
                            </form>
                        @endif
                    @endauth

        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white  rounded-lg p-5 mb-6">
                @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>

                    @if (session('mensaje'))
                        <div class="bg-green-500 text-white p-2 rounded-lg mb-6 text-center">
                            {{ session('mensaje') }}
                        </div>
                    @endif
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

                <div class="bg-white shadow-md mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index',$comentario->user)}}">{{ $comentario->user->username }}</a>
                                <p>{{$comentario->comentario}}</p>
                                <p class="text-gray-500 text-sm ">{{$comentario->created_at->diffForHumans()}}</p>
                            </div>
                        @endforeach
                    @else
                    <p class="p-10 text-center">No hay comentarios para este post</p>

                    @endif

                </div>
            </div>

        </div>

    </div>

@endsection
