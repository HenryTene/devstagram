@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection
@section('contenido')

    <div class="container mx-auto flex">
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
        <div class="md:w-1/2">


        </div>

    </div>

@endsection
