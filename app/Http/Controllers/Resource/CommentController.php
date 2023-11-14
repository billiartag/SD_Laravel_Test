<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    use ApiResponseHelpers;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $validator = Validator::make($request->all(),

            [
                'postId' => 'required',
                'comment' => 'required',
            ]
        );

        $user = auth('sanctum')->user();

        if ($user == null) {
            return $this->respondUnAuthenticated('Token invalid!');
        }
        if ($validator->fails()) {
            return $this->respondFailedValidation('Gagal membuat comment, data tidak lengkap!');
        }


        $comment = new Comment();
        $comment->author_id = $user->id;
        $comment->post_id = $request->input('postId');
        $comment->comment = $request->input('comment');
        $comment->publish_date = date('Y-m-d H:i:s');
//            $comment->update_date = $request->input('update_date');
        $comment->status = 1;

        if ($comment->save()) {
            return $this->respondCreated([
                'message' => 'success',
                'comment' => $comment,
            ]);
        } else {
            return $this->respondError('Post gagal dibuat');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $result = [
            'id' => $comment->id,
            'author_id' => $comment->author_id,
            'author_name' => $comment->author->name,
            'author_email' => $comment->author->email,
            'comment' => $comment->comment,
            'publish_date' => $comment->publish_date,
            'update_date' => $comment->update_date,
            'status' => $comment->status,
        ];

        return $this->respondWithSuccess([
                'message' => 'success',
                'comment' => $result,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $user = auth('sanctum')->user();

        if ($user == null) {
            return $this->respondUnAuthenticated('Token invalid!');
        }
        if (empty($request->all())) {
            return $this->respondForbidden('Tidak ada data yang diubah!');
        }

        if ($user->id != $comment->author_id) {
            return $this->respondUnAuthenticated('User bukan author!');
        }

        $comment->comment = $request->input('comment') ?? $comment->comment;
        $comment->update_date = date('Y-m-d H:i:s');
        $comment->status = $request->input('status') ?? $comment->status;

        if ($comment->save()) {
            return $this->respondCreated([
                'message' => 'success',
                'comment' => $comment,
            ]);
        } else {
            return $this->respondError('Comment gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $user = auth('sanctum')->user();

        if ($user == null) {
            return $this->respondUnAuthenticated('Token invalid!');
        }

        if ($user->id != $comment->author_id) {
            return $this->respondUnAuthenticated('User bukan author!');
        }

        $comment->status = 0;

        if ($comment->save()) {
            return $this->respondCreated([
                'message' => 'success',
                'comment' => $comment,
            ]);
        } else {
            return $this->respondError('Comment gagal dihapus');
        }
    }
}
