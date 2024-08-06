<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Course extends Model
{
    use HasFactory;
    use Sluggable;
    
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
        'resources',
        'mentor_id',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    
    public function users() {
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }
    
}