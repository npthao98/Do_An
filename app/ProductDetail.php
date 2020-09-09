<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $fillable = [
        'product_id',
        'size',
        'color',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_detail_id');
    }
}
