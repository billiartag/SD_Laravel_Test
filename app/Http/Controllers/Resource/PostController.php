<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PharIo\Manifest\Author;

class PostController extends Controller
{
    use ApiResponseHelpers;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $offset = $request->input('page');
        $limit = 10;

        $key = $request->input('key');
        $status = $request->input('status');
        $date = $request->input('date');

        $offset = ($offset - 1) * $limit;


        $result = Post::query()
            ->join('users', 'users.id', '=', 'posts.author_id');


        $result = $result->when($status != null, function ($query) use ($status) {
            return $query->where('status', '=', $status);
        });
        $result = $result->when($key != null, function ($query) use ($key) {
            return $query->where('users.name', 'LIKE', '%' . strtolower($key) . '%');
        });

        $result = $result->when($date != null, function ($query) use ($date) {
            return $query->orderBy('publish_date', $date == 'asc' ? 'asc' : 'desc');
        }, function ($query) {
            return $query->orderBy('publish_date', 'desc');
        });

        $result = $result->offset($offset)
            ->limit($limit)
            ->select(
                'posts.id as postId',
                'posts.title',
                'users.id as authorId',
                'users.name as author',
                'posts.content',
                'posts.publish_date',
                'posts.update_date',
                'posts.status',
            )
            ->get();

        return $this->respondWithSuccess([
                'message' => 'success',
                'count' => count($result),
                'posts' => $result,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->respondOk('BISAFORM');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validator = Validator::make($request->all(),

            [
                'title' => 'required',
                'content' => 'required',
            ]
        );

        $user = auth('sanctum')->user();

        if ($user == null) {
            return $this->respondUnAuthenticated('Token invalid!');
        }
        if ($validator->fails()) {
            return $this->respondFailedValidation('Gagal membuat post, data tidak lengkap!');
        }

        $post = new Post();
        $post->author_id = $user->id;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->publish_date = date('Y-m-d H:i:s');
//            $post->update_date = $request->input('update_date');
        $post->status = 1;

        if ($post->save()) {
            return $this->respondCreated([
                'message' => 'success',
                'post' => $post,
            ]);
        } else {
            return $this->respondError('Post gagal dibuat');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $result = [
            'id' => $post->id,
            'author_id' => $post->author_id,
            'author_name' => $post->author->name,
            'author_email' => $post->author->email,
            'title' => $post->title,
            'content' => $post->content,
            'publish_date' => $post->publish_date,
            'update_date' => $post->update_date,
            'status' => $post->status,
        ];

        return $this->respondWithSuccess([
                'message' => 'success',
                'post' => $result,
                'comments' => $post->comments,
                'like' => $post->likeDislikes,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $user = auth('sanctum')->user();

        if ($user == null) {
            return $this->respondUnAuthenticated('Token invalid!');
        }
        if (empty($request->all())) {
            return $this->respondForbidden('Tidak ada data yang diubah!');
        }

        if ($user->id != $post->author_id) {
            return $this->respondUnAuthenticated('User bukan author!');
        }

        $post->title = $request->input('title') ?? $post->title;
        $post->content = $request->input('content') ?? $post->content;
        $post->update_date = date('Y-m-d H:i:s');
        $post->status = $request->input('status') ?? $post->status;

        if ($post->save()) {
            return $this->respondCreated([
                'message' => 'success',
                'post' => $post,
            ]);
        } else {
            return $this->respondError('Post gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $user = auth('sanctum')->user();

        if ($user == null) {
            return $this->respondUnAuthenticated('Token invalid!');
        }

        if ($user->id != $post->author_id) {
            return $this->respondUnAuthenticated('User bukan author!');
        }

        $post->status = 0;

        if ($post->save()) {
            return $this->respondCreated([
                'message' => 'success',
                'post' => $post,
            ]);
        } else {
            return $this->respondError('Post gagal dihapus');
        }
    }
}
