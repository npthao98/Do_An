<?php
namespace App\Repositories\Comment;

use App\Repositories\BaseRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Models\Rate;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function getModel()
    {
        return Rate::class;
    }

    public function showComment($id)
    {
        $result = $this->model->where('product_id', $id)->orderBy('created_at', 'desc')->paginate(config('comment.paginate'));

        return $result;
    }
}
