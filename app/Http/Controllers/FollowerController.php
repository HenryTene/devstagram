<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user, Request $request)
    {
        $user->followers()->attach($request->user()->id);
        return back()->with('success', 'Ahora sigues a ' . $user->username);
    }

}
