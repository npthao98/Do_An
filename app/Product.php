<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'in_stock',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }
}
