<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

use App\Models\Tools;
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
        return $this->hasMany(Transaction::class);
    }
    
    public function ebook()
    {
        return $this->hasOne(Ebook::class, 'course_id', 'id');
    }

    public function tools()
    {
        return $this->belongsToMany(Tools::class, 'tbl_course_tools', 'course_id', 'tool_id');
    }

}