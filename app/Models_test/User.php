<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'fullname',
        'email',
        'username',
        'password',
        'avatar',
        'status',
        'phone',
        'birthday',
        'gender',
        'address',
        'user_id_platform',
        'role_id',
    ];

    public $timestamps = true;
}
