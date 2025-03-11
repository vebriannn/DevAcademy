<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Lesson extends Model
    {
        use HasFactory;

        protected $table = 'tbl_lessons';

        protected $fillable = [
            'chapter_id',
            'name',
            'slug_episode',
            'link_videos',
        ];

        public function chapters()
        {
            return $this->belongsTo(Chapter::class, 'chapter_id', 'id');
        }
    }
