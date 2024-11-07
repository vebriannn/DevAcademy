<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiskonKelas extends Model
{
    use HasFactory;

    protected $table = 'tbl_diskon_kelas';

    protected $fillable = [
        'kode_diskon',
        'rate_diskon',
    ];
}
