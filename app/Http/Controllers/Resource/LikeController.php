<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\LikeDislike;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    use ApiResponseHelpers;

    public function update(Request $request)
    {

        $user = auth('sanctum')->user();

        $likeDislike = LikeDislike::find($request->input('id'));
        if ($likeDislike == null) {
            return $this->respondNoContent('Data not found');
        }

        if ($user == null) {
            return $this->respondUnAuthenticated('Token invalid!');
        }
        if (empty($request->all())) {
            return $this->respondForbidden('Tidak ada data yang diubah!');
        }

        if ($user->id != $likeDislike->author_id) {
            return $this->respondUnAuthenticated('User bukan author!');
        }

        $likeDislike->type = $request->input('type') ?? $likeDislike->type;
        $likeDislike->status = $request->input('status') ?? $likeDislike->status;

        if ($likeDislike->save()) {
            return $this->respondCreated([
                'message' => 'success',
                'like' => $likeDislike,
            ]);
        } else {
            return $this->respondError('Like gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $likeDislike = LikeDislike::find($request->input('id'));
        if ($likeDislike == null) {
            return $this->respondNoContent('Data not found');
        }
        $user = auth('sanctum')->user();

        if ($user == null) {
            return $this->respondUnAuthenticated('Token invalid!');
        }

        if ($user->id != $likeDislike->author_id) {
            return $this->respondUnAuthenticated('User bukan author!');
        }

        $likeDislike->status = 0;

        if ($likeDislike->save()) {
            return $this->respondCreated([
                'message' => 'success',
                'like' => $likeDislike,
            ]);
        } else {
            return $this->respondError('Like gagal dihapus');
        }
    }
}
