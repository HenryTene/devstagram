<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        // Obtener a quienes seguimos
        dd(Auth::user()->following->pluck('id')->toArray());
        return view('home');
    }
}
