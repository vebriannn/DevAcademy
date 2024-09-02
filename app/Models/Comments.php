<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Forum;
use App\Models\User;


class Comments extends Model
{
    use HasFactory;

    protected $table = 'tbl_comments';

    protected $fillable = [
        'user_id',
        'forum_id',
        'comment',
        'reply',
        'parent_id',
    ];

    /**
     * Relasi ke model Forum.
     * Sebuah komentar terkait dengan satu forum.
     */
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
    

    /**
     * Relasi ke model User (pembuat komentar).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke komentar parent.
     */
    public function parent()
    {
        return $this->belongsTo(Comments::class, 'parent_id');
    }

    /**
     * Relasi ke balasan komentar.
     * Balasan adalah komentar yang memiliki parent_id yang sama dengan komentar ini.
     */
    public function replies()
    {
        return $this->hasMany(Comments::class, 'parent_id');
    }
}