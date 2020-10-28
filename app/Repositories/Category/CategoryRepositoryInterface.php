<?php
namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{
    public function deleteCategory($id);
    
    public function findChildrenCategory();

    public function findOneChildrenCategory($id);
}
