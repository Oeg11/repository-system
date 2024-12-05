<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class studentModel extends Authenticatable
{

   protected $guard = 'student_models';

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'department_id',
        'curriculum_id',
        'role',
        'status',
        'google_id',
        'remember_token',


    ];


   protected $hidden = [
       'password',
       'remember_token',
   ];

   /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
   protected $casts = [
       'email_verified_at' => 'datetime',
       'password' => 'hashed',
   ];

    use HasFactory;
}
