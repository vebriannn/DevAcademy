<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ebook extends Model
{
    use HasFactory;

    protected $table = 'tbl_ebooks';

    protected $fillable = [
        'cover',
        'category',
        'name',
        'type',
        'status',
        'level',
        'price',
        'description',
        'file_ebook',
        'mentor_id',
        'slug'
    ];

    public static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    // In Ebook.php model
    public function courseEbooks()
    {
        return $this->hasMany(CourseEbook::class, 'ebook_id');
    }

}
