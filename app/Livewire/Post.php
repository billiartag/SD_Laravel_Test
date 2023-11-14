<?php

namespace App\Livewire;

use Livewire\Component;

class Post extends Component
{
    public $id;
    public $title;
    public $author;
    public $content;

    public function render()
    {
        return view('livewire.post');
    }

    public function doGoPost()
    {
        return redirect()->route('postScreen', [
            'id' => $this->id,
        ]);
    }

    public function doLike()
    {
    }

    public function doDislike()
    {
    }
}
