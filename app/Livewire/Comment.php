<?php

namespace App\Livewire;

use Livewire\Component;

class Comment extends Component
{
    public $id;
    public $author;
    public $comment;

    public function render()
    {
        return view('livewire.comment');
    }

    public function doLike()
    {
    }

    public function doDislike()
    {
    }
}
