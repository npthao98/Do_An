<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Comment\CommentRepositoryInterface;

class CommentController extends Controller
{
    protected $commentRepo;

    public function __construct(CommentRepositoryInterface $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    public function createComment(Request $request, $id)
    {
        $data = $request->all();
        $image = asset('bower_components/bower_fashi_shop/img/product-single/avatar.jpg');

        if (auth()->check()) {
            $data['user_id'] = auth()->id();
            $username = auth()->user()->name;
        }

        try {
            $comment = $this->commentRepo->create($data);
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

        try {
            $this->commentRepo->update($request->comment_id, $data);
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
