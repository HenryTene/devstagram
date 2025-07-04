@extends('layouts.app')

@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
<div class="flex justify-center">
    <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
        <div class="w-8/12 lg:w-6/12 px-5 ">
            <img src="{{
                $user->imagen ?
                asset('perfiles').'/'.$user->imagen :
                asset('img/usuario.svg')}}"
                alt="imagen de usuario">
        </div>
        <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center  md:items-start py-10">

            <div class="flex items-center gap-2">
                <p class="text-gray-700 text-2xl">{{$user->username}}</p>
                @auth
                    @if($user->id === auth()->user()->id)
                        <a
                            href="{{ route('perfil.index') }}"
                            class="text-gray-600 hover:text-gray-700 cursor-pointer"
                        >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path d="m2.695 14.762-1.262 3.155a.5.5 0 0 0 .65.65l3.155-1.262a4 4 0 0 0 1.343-.886L17.5 5.501a2.121 2.121 0 0 0-3-3L3.58 13.419a4 4 0 0 0-.885 1.343Z" />
                                </svg>
                        </a>
                    @endif
                @endauth
            </div>

            <p class="text-gray-700 text-sm mb-3 font-bold mt-5">
                {{ $user->followers->count() }}
                <span class="font-normal">@choice('Seguidor|Seguidores',$user->followers->count())</span>
            </p>
            <p class="text-gray-700 text-sm mb-3 font-bold">
                {{ $user->followings->count() }}
                <span class="font-normal">Siguiendo </span>
            </p>
            <p class="text-gray-700 text-sm mb-3 font-bold">
                {{ $user->posts->count() }}
                <span class="font-normal"> @choice('Post|Posts',$user->posts->count())</span>
            </p>

            @auth
                @if ($user->id !== auth()->user()->id)
                    @if (!$user->siguiendo(Auth::user()))
                        <form
                            action="{{ route('users.follow', $user) }}"
                            method="POST"
                            class="mt-5"
                        >
                            @csrf
                        <input
                                type="submit"
                                class="bg-sky-600 hover:bg-sky-700 text-white font-semibold text-xs uppercase px-3 py-1 rounded-lg cursor-pointer shadow-sm transition duration-200 mt-1 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2"
                                value="Seguir"
                            />
                        </form>
                    @else
                        <form
                            action="{{ route('users.unfollow', $user) }}"
                            method="POST"
                            class="mt-5"
                        >
                            @csrf
                            @method('DELETE')
                        <input
                                type="submit"
                                class="bg-sky-600 hover:bg-sky-700 text-white font-semibold text-xs uppercase px-3 py-1 rounded-lg cursor-pointer shadow-sm transition duration-200 mt-1 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2"
                                value="Dejar de seguir"
                            />
                        </form>
                    @endif

                @endif

            @endauth

        </div>
    </div>
</div>

<section class="container mx-auto mt-10">
    <h2 class="text-2xl text-center font-bold mt-10 mb-5"> Publicaciones </h2>
        <x-listar-post :posts="$posts" />
    </h2>
</section>

@endsection
