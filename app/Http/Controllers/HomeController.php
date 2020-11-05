<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Category\CategoryRepositoryInterface;

class HomeController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $categories = $this->categoryRepo->findChildrenCategory()->orderBy('created_at')->limit(config('category.limit'))->get();
        $categoryFirst = $categories->first();
        $categorySecond = $categories->skip(config('category.skip'))->first();

        return view('fashi.user.index', compact(['categories', 'categoryFirst', 'categorySecond']));

    }

    public function changeLanguage($language)
    {
        session()->put('website_language', $language);

        return redirect()->back();
    }
}
