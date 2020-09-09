<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
