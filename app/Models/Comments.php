<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $table = 'tbl_comments';

    protected $fillable = [
        'user_id',
        'forum_id',
        'comment',
    ];
}