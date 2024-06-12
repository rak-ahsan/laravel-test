<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
{

    protected $fillable = [
        'user_id',
        'transaction_type',
        'amount',
        'fee',
        'date',
    ];
    use HasFactory;
    protected $casts = [
        'date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


