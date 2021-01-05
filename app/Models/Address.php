<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $table = "addresses";

    protected $fillable = [
        'apartment_number',
        'street',
        'district',
        'city',
        'person_id',
    ];

    public $timestamps = true;

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
