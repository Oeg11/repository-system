<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class department extends Model
{

    protected $guard = 'departments';

    protected $fillable = [
        'name',
        'description',

    ];

    use HasFactory;
}
