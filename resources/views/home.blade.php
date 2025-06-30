@extends('layouts.app')

@section('titulo')

Página Principal Home

@endsection


@section('contenido')

    <x-listar-post :posts="$posts"/>

@endsection
