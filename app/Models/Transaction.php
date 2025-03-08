<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'tbl_transactions';

    protected $fillable = [
        'transaction_code',
        'user_id',
        'name_class',
        'type_class',
        'price',
        'status',
        'snap_token',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
