<?php
namespace App\Repositories\Product;

use Illuminate\Http\Request;

interface ProductRepositoryInterface
{
    public function getRandomProduct();

    public function searchProduct($request);
}
