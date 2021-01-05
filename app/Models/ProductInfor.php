<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductInfor extends Model
{
    use SoftDeletes;

    protected $table = "product_infors";

    protected $fillable = [
        'size',
        'color',
        'quantity',
        'product_id',
    ];

    public $timestamps = true;

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function itemImports()
    {
        return $this->hasMany(ItemImport::class);
    }
}
