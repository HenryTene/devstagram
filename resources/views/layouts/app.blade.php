<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('styles')
    <title>DevStagram - @yield('titulo')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-black">
                DevStagram
            </a>
            @auth()
            <nav class="flex gap-2 items-center">
                <a class="flex items-center gap-3 bg-blue-500 hover:bg-blue-600 border p-2 text-white rounded-lg text-sm uppercase font-bold cursor-pointer"
                    href=" {{ route('posts.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                            clip-rule="evenodd" />
                    </svg>
                    Crear
                </a>
                <a class="font-bold text-gray-600" href="{{ route('posts.index', auth()->user()->username) }}">
                    Hola:
                    <span class="font-normal">
                        {{ auth()->user()->username }}
                    </span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="font-bold uppercase text-gray-600">
                        Cerrar Sesión
                    </button>
                </form>

            </nav>
            @endauth

            @guest()
            <nav class="flex gap-2 items-center">
                <a class="font-bold uppercase text-gray-600" href="{{route('login')}}">
                    Login
                </a>
                <a href="{{route('register')}}" class="font-bold uppercase text-gray-600">
                    Crear cuenta
                </a>
            </nav>
            @endguest
        </div>
    </header>
    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('titulo')
        </h2>
        @yield('contenido')
    </main>

    <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
        DevStagram - Todos los derechos reservados {{ now()->year }}
    </footer>
    @livewireScripts
</body>

</html>
