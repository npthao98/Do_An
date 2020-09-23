<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::whereNotNull('parent_id')->get();

        return view('fashi.user.shop', compact(['products', 'categories']));
    }

    public function showProductByCategory($id)
    {
        $categories = Category::whereNotNull('parent_id')->get();
        $category = Category::with('products.images')->whereNotNull('parent_id')->findOrFail($id);
        $products = $category->products;

        return view('fashi.user.shop', compact(['products', 'categories']));
    }
}
