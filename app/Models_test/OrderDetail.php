<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use SoftDeletes;

    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'product_detail_id',
        'product_detail_price',
        'quantity',
    ];

    public $timestamps = true;
}
