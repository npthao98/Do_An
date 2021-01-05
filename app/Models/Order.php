<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = "orders";

    protected $fillable = [
        'time',
        'status',
        'address',
        'receiver',
        'phone',
        'fee_shipment',
        'type_shipment',
        'status_payment',
        'type_payment',
        'total_price',
        'customer_id',
    ];

    public $timestamps = true;

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
