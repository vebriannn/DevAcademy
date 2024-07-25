<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cover',
        'type',
        'status',
        'price',
        'level',
        'description',
        'mentor_id',
    ];
}