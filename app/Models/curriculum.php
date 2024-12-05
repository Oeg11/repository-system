<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class curriculum extends Model
{
    protected $guard = 'curricula';

    protected $fillable = [
        'department_id',
        'name',
        'description',

    ];

    use HasFactory;

}
