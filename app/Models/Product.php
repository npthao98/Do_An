<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = "products";

    protected $fillable = [
        'name',
        'rate',
        'description',
        'price_import',
        'price_sale',
        'link_to_image_base',
        'category_id',
    ];

    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function productInfors()
    {
        return $this->hasMany(ProductInfor::class);
    }
}
