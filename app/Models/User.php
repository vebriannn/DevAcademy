<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\CustomVerifyEmailNotification;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'avatar',
        'name',
        'email',
        'password',
        'profession',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // costum verifikasi
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmailNotification());  // Sesuaikan dengan notifikasi kustom
    }

    /**
     * Relasi ke model Course.
     * Seorang user (mentor) dapat memiliki banyak course.
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'mentor_id', 'id');
    }

    /**
     * Relasi ke model Transaction.
     * Seorang user dapat memiliki banyak transaksi.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    /**
     * Relasi ke model Forum.
     * Seorang user dapat membuat banyak forum.
     */
    public function forums()
    {
        return $this->hasMany(Forum::class);
    }

    /**
     * Relasi ke model Comments.
     * Seorang user dapat membuat banyak komentar.
     */
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
}
