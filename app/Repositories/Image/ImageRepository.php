<?php
namespace App\Repositories\Image;

use App\Repositories\BaseRepository;
use App\Repositories\Image\ImageRepositoryInterface;
use App\Image;
use App\Product;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    public function getModel()
    {
        return Image::class;
    }

    public function findImageByProduct($id)
    {
        $result = $this->model->where('product_id', $id);

        return $result;
    }
}
