<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTools extends Model
{
    use HasFactory;

    protected $table = 'tbl_course_tools';

    protected $fillable = [
        'course_id',
        'tool_id'
    ];
}