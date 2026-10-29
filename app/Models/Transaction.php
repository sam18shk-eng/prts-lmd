<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'description',
        'transaction_date',
    ];

    // Relasi ke User
    public function user()
    {
        return $table->belongsTo(User::class);
    }
}