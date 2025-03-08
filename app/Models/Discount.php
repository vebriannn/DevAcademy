<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'tbl_discount_class';

    protected $fillable = [
        'code_discount',
        'rate_discount',
    ];
}
