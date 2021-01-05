<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Person extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = "persons";

    protected $fillable = [
        'username',
        'password',
        'first_name',
        'midd_name',
        'last_name',
        'status',
    ];

    public $timestamps = true;

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }
}
