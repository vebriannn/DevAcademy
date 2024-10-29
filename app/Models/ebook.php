<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;

    protected $table = 'tbl_ebooks';

    protected $fillable = [
        'course_id',
        'cover',
        'name',
        'type',
        'status',
        'level',
        'price',
        'description',
        'ebook',
        'category',
        'mentor_id',
        'slug'
    ];



    // Define the relationship with Course
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'tbl_course_ebooks', 'ebook_id', 'course_id');
    }

    public static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
