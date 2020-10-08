<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::whereNotNull('parent_id')->orderBy('created_at')->limit(config('category.limit'))->get();
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
