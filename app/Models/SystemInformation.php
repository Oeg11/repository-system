<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemInformation extends Model
{

    protected $guard = 'system_information';

    protected $fillable = [
        'system_name',
        'system_short_name',
        'description',
        'about',
        'email',
        'contact_number',
        'address'

    ];

    use HasFactory;
}
