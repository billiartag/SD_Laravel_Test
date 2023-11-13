<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLikeDislikeRequest;
use App\Http\Requests\UpdateLikeDislikeRequest;
use App\Models\LikeDislike;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikeDislikeController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLikeDislikeRequest $request)
    {
        $validator = Validator::make($request->all(),

            [
                'postId' => 'required',
                'type' => 'in:0,1',
            ]
        );

        $user = auth('sanctum')->user();

        if ($user == null) {
            return $this->respondUnAuthenticated('Token invalid!');
        }
        if ($validator->fails()) {
            return $this->respondFailedValidation('Gagal membuat comment, data tidak lengkap!');
        }

        $check = LikeDislike::where('post_id', $request->input('postId'))
            ->where('comment_id', $request->input('commentId'))
            ->where('author_id', $user->id)->first();

        if ($check != null) {

            return $this->respondForbidden('Sudah terdapat like pada post / comment ini');
        }


        $likeDislike = new LikeDislike();
        $likeDislike->author_id = $user->id;
        $likeDislike->post_id = $request->input('postId');
        $likeDislike->comment_id = $request->input('commentId');
        $likeDislike->type = $request->input('type');
        $likeDislike->publish_date = date('Y-m-d H:i:s');
//            $likeDislike->update_date = $request->input('update_date');
        $likeDislike->status = 1;

        if ($likeDislike->save()) {
            return $this->respondCreated([
                'message' => 'success',
                'like' => $likeDislike,
            ]);
        } else {
            return $this->respondError('Post gagal dibuat');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LikeDislike $likeDislike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LikeDislike $likeDislike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LikeDislike $likeDislike)
    {
        $user = auth('sanctum')->user();

//        print_r($request->all());
//        print_r(LikeDislike::find($request->input('id')));

        return response()->json($likeDislike);
//        return response()->json($request);
        echo 'ini ID:' . $request->input('id');
//
//
//        if ($user == null) {
//            return $this->respondUnAuthenticated('Token invalid!');
//        }
//        if (empty($request->all())) {
//            return $this->respondForbidden('Tidak ada data yang diubah!');
//        }
//
//        if ($user->id != $likeDislike->author_id) {
//            echo 'user id = ' . $user->id . '<br>';
//            echo 'author_id = ' . $likeDislike->author_id . '<br>';
//            print_r($likeDislike);
//            return $this->respondUnAuthenticated('User bukan author!');
//        }
//
//        $likeDislike->type = $request->input('type') ?? $likeDislike->type;
//        $likeDislike->update_date = date('Y-m-d H:i:s');
//        $likeDislike->status = $request->input('status') ?? $likeDislike->status;
//
//        if ($likeDislike->save()) {
//            return $this->respondCreated([
//                'message' => 'success',
//                'like' => $likeDislike,
//            ]);
//        } else {
//            return $this->respondError('Like gagal diubah');
//        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LikeDislike $likeDislike)
    {
        return response()->json($likeDislike);
//        $user = auth('sanctum')->user();
//
//        if ($user == null) {
//            return $this->respondUnAuthenticated('Token invalid!');
//        }
//
//        if ($user->id != $likeDislike->author_id) {
//            return $this->respondUnAuthenticated('User bukan author!');
//        }
//
//        $likeDislike->status = 0;
//
//        if ($likeDislike->save()) {
//            return $this->respondCreated([
//                'message' => 'success',
//                'like' => $likeDislike,
//            ]);
//        } else {
//            return $this->respondError('Like gagal dihapus');
//        }
    }
}
