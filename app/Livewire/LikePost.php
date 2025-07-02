<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;

    public function like()
    {
        return "Desde Like";
    }
    public function render()
    {
        return view('livewire.like-post');
    }
}
