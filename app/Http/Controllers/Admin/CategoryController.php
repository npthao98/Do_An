<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    /**
    * @var PostRepositoryInterface|\App\Repositories\Repository
    */
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepo->getAll();

        return view('fashi.admin.category.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
