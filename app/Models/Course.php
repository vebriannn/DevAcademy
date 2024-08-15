<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Course extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'tbl_courses';
    protected $fillable = [
        'category',
        'name',
        'slug',
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

    public function users()
    {
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }
}