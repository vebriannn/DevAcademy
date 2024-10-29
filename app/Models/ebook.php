<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;

    protected $table = 'tbl_ebooks';

    protected $fillable = [
        'category',
        'slug',
        'name',
        'type',
        'status',
        'level',
        'price',
        'description',
        'source_ebook',
        'mentor_id'
    ];



    // Define the relationship with Course
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'tbl_course_ebooks', 'ebook_id', 'course_id');
    }
    // Define the relationship with User
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
