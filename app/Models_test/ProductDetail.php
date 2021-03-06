<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use SoftDeletes;

    protected $table = 'product_details';

    protected $fillable = [
        'product_id',
        'quantity',
        'size',
        'color',
    ];

    public $timestamps = true;
}
