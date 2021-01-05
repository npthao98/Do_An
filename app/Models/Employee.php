<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $table = "employees";

    protected $fillable = [
        'internal_mail',
        'person_id',
        'image_employee',
        'description',
    ];

    public $timestamps = true;

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function imports()
    {
        return $this->hasMany(Import::class);
    }
}
