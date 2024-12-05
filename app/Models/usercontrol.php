<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usercontrol extends Model
{

    protected $guard = 'usercontrols';

    protected $fillable = [
        'staff_id',
        'collectionlist_view',
        'collectionlist_updatestatus',
        'collectionlist_delete'

    ];

    use HasFactory;
}
