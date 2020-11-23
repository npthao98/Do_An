<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'product_base_id',
        'description',
        'price',
        'link_to_image_base',
    ];

    public $timestamps = true;
}
