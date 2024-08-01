<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'tbl_courses';
    protected $fillable = [
        'category',
        'name',
        'cover',
        'type',
        'status',
        'price',
        'level',
        'description',
        'mentor_id',
    ];

    public function users() {
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }
    
}