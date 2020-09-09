<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'product_id',
        'link_to_image',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
