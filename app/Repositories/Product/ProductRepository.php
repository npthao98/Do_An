<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }

    public function getRandomProduct()
    {
        $result = $this->model->inRandomOrder()->limit(config('product.random'))->get();

        return $result;
    }

    public function searchProduct($request)
    {
        $result = $this->model->where('name', 'LIKE', "%{$request}%")->get();

        return $result;
    }
}
