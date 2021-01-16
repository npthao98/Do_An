<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Rate;

class CommentController extends Controller
{
    protected $commentRepo;

    public function __construct(CommentRepositoryInterface $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    public function createComment(Request $request, $id)
    {
        $image = asset('images/avatar.jpg');

        if (auth()->check()) {
            $data['user_id'] = auth()->id();
            $username = auth()->user()->username;
        }

        try {
            $comment = Rate::where([
                'product_id' => $id,
                'customer_id' => Auth::user()->customer->id,
                'rate' => 0,
            ])->first();
            $comment->update([
                'rate' => $request['rate'],
                'comment' => $request['content'],
            ]);
            $product = Product::find($id);
            $numberOfRates = $product->rates()->count();
            $totalOfRates = $product->rates()->sum('rate');
            if ($totalOfRates > 0) {
                $rate = $totalOfRates / $numberOfRates;
                $product->update([
                    'rate' => $rate,
                ]);
            }
        } catch (Exception $e) {
            return response()->json();
        }

        $result = [
            'content' => $request['content'],
            'rate' => $request['rate'],
            'user' => $username,
            'image' => $image,
            'close' => trans('text.close'),
            'save_change' => trans('text.save_change'),
            'edit' => trans('text.edit'),
            'delete' => trans('text.delete'),
            'comment_id' => $comment->id,
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
