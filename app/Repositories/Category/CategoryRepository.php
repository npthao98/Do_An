<?php
namespace App\Repositories\Category;

use App\Repositories\BaseRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function deleteCategory($id)
    {
        $category = $this->model->find($id);
        $categories = $category->children;

        if ($category->parent_id != null) {
            $category->delete();

            return true;
        } else {
            $category->delete();

            foreach ($categories as $parent) {
                $parent->update(['parent_id' => null]);
            }

            return true;
        }

        return false;
    }
}
