<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemImport extends Model
{
    use SoftDeletes;

    protected $table = "item_imports";

    protected $fillable = [
        'quantity',
        'price_import',
        'product_infor_id',
        'import_id',
    ];

    public $timestamps = true;

    public function productInfor()
    {
        return $this->belongsTo(ProductInfor::class);
    }

    public function import()
    {
        return $this->belongsTo(Import::class);
    }
}
