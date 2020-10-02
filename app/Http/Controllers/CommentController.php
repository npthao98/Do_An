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

        if (auth()->check()) {
            $data['user_id'] = auth()->id();
            $username = auth()->user()->name;
        }

        $images = Product::findOrFail($id)->images;
        if ($images->first()) {
            $image = $images->first()->link_to_image;
        }

        try {
            Comment::create($data);
        } catch (Exception $e) {
            return response()->json();
        }

        $result = [
            'content' => $data['content'],
            'user' => $username,
            'image' => $image,
        ];

        return response()->json($result);
    }
}
