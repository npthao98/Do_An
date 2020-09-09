<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'level',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }
}
