<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class backup extends Model
{

    protected $guard = 'backupdatabase';

    protected $fillable = [
        'date_store',
        'database_path'
    ];

    use HasFactory;
}
