<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class archive extends Model
{

    protected $guard = 'archives';

    protected $fillable = [
        'archive_code',
        'category',
        'department_id',
        'curriculum_id',
        'year',
        'title',
        'abstract',
        'members',
        'adviser',
        'banner_path',
        'document_path',
        'status',
        'remark',
        'student_id',
        'slug',
        'count_rank',
        'google_id',
        'usercontrol_id',
        'collectionlist_view',
        'collectionlist_updatestatus',
        'collectionlist_delete',
    ];





    use HasFactory;
}
