<?php
namespace App\Repositories\ProductDetail;

use App\Repositories\BaseRepository;
use App\Repositories\ProductDetail\ProductDetailRepositoryInterface;
use App\ProductDetail;

class ProductDetailRepository extends BaseRepository implements ProductDetailRepositoryInterface
{
    public function getModel()
    {
        return ProductDetail::class;
    }
}
