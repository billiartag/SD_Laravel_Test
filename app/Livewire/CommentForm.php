<?php

namespace App\Livewire;

use Livewire\Component;

class CommentForm extends Component
{
    public $comment;

    public function render()
    {
        return view('livewire.comment-form');
    }
}
