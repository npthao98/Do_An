<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'time',
        'status',
        'check_rate',
        'total_price',
    ];

    public $timestamps = true;
}
