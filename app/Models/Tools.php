<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tools extends Model
{
    use HasFactory;

    protected $table = 'tbl_tools';

    protected $fillable = [
        'name_tools',
        'logo_tools'
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'tbl_course_tools', 'tool_id', 'course_id');
    }
}