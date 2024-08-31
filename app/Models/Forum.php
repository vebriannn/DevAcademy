<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $table = 'tbl_forums';

    protected $fillable = [
        'course_id',
        'user_id',
        'title',
    ];

    /**
     * Relasi ke model Course.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relasi ke model User (pembuat forum).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Comments.
     * Sebuah forum memiliki banyak komentar.
     */
    public function comments()
    {
        return $this->hasMany(Comments::class, 'forum_id');
    }
}