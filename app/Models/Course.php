<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

use App\Models\Tools;
use App\Models\Ebook;
use App\Models\Forum;
use App\Models\Transaction;
use App\Models\User;

class Course extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'tbl_courses';

    protected $fillable = [
        'mentor_id',           // Foreign key untuk mentor
        'category',          // Kategori kursus
        'name',              // Nama kursus
        'slug',              // Slug kursus
        'cover',             // Gambar cover
        'type',              // free atau premium
        'status',            // draft atau published
        'price',             // Harga kursus
        'level',             // Tingkat kesulitan (beginner, intermediate, expert)
        'sort_description',  // Deskripsi singkat
        'long_description',  // Deskripsi panjang
        'link_resources',    // Link sumber daya
        'link_groups',       // Link grup
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    // Di dalam model Course
    public function users()
    {
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Relasi: satu course memiliki banyak chapters
    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'course_id');
    }

    public function tools()
    {
        return $this->belongsToMany(Tools::class, 'tbl_course_tools', 'course_id', 'tool_id');
    }
}
