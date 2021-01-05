<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Import extends Model
{
    use SoftDeletes;

    protected $table = "imports";

    protected $fillable = [
        'date',
        'employee_id',
    ];

    public $timestamps = true;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function itemImports()
    {
        return $this->hasMany(ItemImport::class);
    }
}
