<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class HomeController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        if (Auth::check() && !Auth::user()->employee) {
            $client = new \GuzzleHttp\Client();

            $request = $client->get('http://localhost:5000/recommendations', [
                'query' => ['customer' => Auth::user()->customer->id]
            ]);
            $response = $request->getBody();
            $recommendations = json_decode($response)->data;
        } else {
            $recommendations = Product::take(7)->pluck('id')->toArray();
        }
        $products = Product::whereIn('id', $recommendations)->get();
        $categories = $this->categoryRepo->findChildrenCategory()->orderBy('created_at')->limit(config('category.limit'))->get();
        $categoryFirst = $categories->first();
        $categorySecond = $categories->skip(config('category.skip'))->first();

        return view('fashi.user.index', compact(
            'categories',
            'categoryFirst',
            'categorySecond',
            'products'
        ));

    }

    public function changeLanguage($language)
    {
        session()->put('website_language', $language);

        return redirect()->back();
    }
}
