<?php

namespace App\Livewire;

use App\Http\Controllers\Post\PostsController;
use Livewire\Component;

class PostList extends Component
{
    public $data;
    public $page;
    public $key;
    public $status;
    public $date;

    public function mount()
    {

        $this->page = '';
        $this->key = '';
        $this->status = '';
        $this->date = '';

        // get Data
        $params = [
            'page' => $this->page,
            'key' => $this->key,
            'status' => $this->status,
            'date' => $this->date,
        ];
        $response = app(PostsController::class)->getPosts($params);
        
        $this->data = $response;
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
