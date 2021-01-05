<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $table = "items";

    protected $fillable = [
        'quantity',
        'price_sale',
        'price_import',
        'product_infor_id',
        'order_id',
    ];

    public $timestamps = true;

    public function productInfor()
    {
        return $this->belongsTo(ProductInfor::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
