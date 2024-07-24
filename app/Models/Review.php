<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'rating',
        'note',
    ];

    // Add this line to specify the table name
    protected $table = 'tbl_reviews';
}
