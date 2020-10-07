<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Comment;
use RealRashid\SweetAlert\Facades\Alert;


class CommentController extends Controller
{
    public function createComment(Request $request, $id)
    {
        $data = $request->all();
        $image = asset('bower_components/bower_fashi_shop/img/product-single/avatar-2.png');

        if (auth()->check()) {
            $data['user_id'] = auth()->id();
            $username = auth()->user()->name;
        }

        try {
            $comment = Comment::create($data);
        } catch (Exception $e) {
            return response()->json();
        }

        $result = [
            'content' => $data['content'],
            'user' => $username,
            'image' => $image,
            'close' => trans('text.close'),
            'save_change' => trans('text.save_change'),
            'edit' => trans('text.edit'),
            'delete' => trans('text.delete'),
            'comment_id' => $comment->id,
            'content' => $comment->content,
        ];

        return response()->json($result);
    }

    public function editComment(Request $request, $id)
    {
        $data = $request->only([
            'product_id',
            'content',
        ]);

        $data['user_id'] = auth()->id();
        $comment = Comment::findOrFail($request->comment_id);
        try {
            $comment->update($data);
        } catch (Exception $e) {
            $result = [
                'status' => false,
                'message' => trans('message.comment.update.error'),
                'icon' => 'error',
            ];

            return response()->json($result);
        }

        $result = [
            'status' => true,
            'message' => trans('message.comment.update.success'),
            'icon' => 'success',
        ];

        return response()->json($result);
    }
}
