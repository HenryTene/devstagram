<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likesCount;

    public function mount($post)
    {
        $this->isLiked = Auth::check() ? $post->checkLike(Auth::user()) : false;
        $this->likesCount = $post->likes->count();
    }

    public function like()
    {
        if (!Auth::check()) {
            return;
        }

        if ($this->post->checkLike(Auth::user())) {
            $this->post->likes()->where('user_id', Auth::user()->id)->delete();
            $this->isLiked = false;
            $this->likesCount--;
        } else {
            $this->post->likes()->create([
                'user_id' => Auth::user()->id
            ]);
            $this->isLiked = true;
            $this->likesCount++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
