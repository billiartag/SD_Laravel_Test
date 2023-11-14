<?php

namespace App\Livewire;

use Livewire\Component;

class Post extends Component
{
    public $title;
    public $author;
    public $content;

    public function render()
    {
        $this->title = 'title';
        $this->author = 'author';
        $this->content = 'content';
        return view('livewire.post');
    }

    public function doGoPost()
    {
        return redirect()->route('postScreen', [
            'id' => 1,
        ]);
    }

    public function doLike()
    {
    }

    public function doDislike()
    {
    }
}
