<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'link_to_image',
    ];

    public $timestamps = true;
}
