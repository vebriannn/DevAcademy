<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbookTools extends Model
{
    use HasFactory;

    protected $table = 'tbl_course_ebooks';

    protected $fillable = [
        'course_id',
        'ebook_id'
    ];
}
