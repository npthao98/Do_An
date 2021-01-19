<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $categories = $this->categoryRepo->getAll();

        foreach ($categories as $category) {
            $parents = explode(',', $category->fullpath);
            $parent = $parents[sizeof($parents)-1];
            $category->parent = Category::find($parent);
        }

        return view('fashi.admin.category.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        try {
            $this->categoryRepo->create($request->all());
        } catch (Exception $e) {
            Log::error($e);

            return back()->with('message', trans('message.category.create.error'));
        }

        return redirect()->route('admin.categories.index')->with('message', trans('message.category.create.success'));
    }

    public function update($id, CategoryRequest $request)
    {
        try {
            $this->categoryRepo->update($id, $request->all());
        } catch (Exception $e) {
            Log::error($e);

            return back()->with('message', trans('message.category.update.error'));
        }

        return redirect()->route('admin.categories.index')->with('message', trans('message.category.update.success'));
    }

    public function destroy($id)
    {
        try {
            $this->categoryRepo->deleteCategory($id);
        } catch (Exception $e) {
            Log::error($e);

            return back()->with('message', trans('message.category.delete.error'));
        }

        return redirect()->route('admin.categories.index')->with('message', trans('message.category.delete.success'));
    }
}
