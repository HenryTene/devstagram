<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        dd('Desde Muro');
        //return view('posts.index');
    }
}
