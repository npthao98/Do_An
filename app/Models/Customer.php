<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = "customers";

    protected $fillable = [
        'gender',
        'birthday',
        'email',
        'phone',
        'person_id',
    ];

    public $timestamps = true;

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}
