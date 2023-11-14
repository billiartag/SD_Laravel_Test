<?php

namespace App\Livewire;

use Livewire\Component;

class Comment extends Component
{
    public $author;
    public $comment;

    public function render()
    {
        $this->author = 'author';
        $this->comment = 'comments';
        return view('livewire.comment');
    }

    public function doLike()
    {
    }

    public function doDislike()
    {
    }
}
