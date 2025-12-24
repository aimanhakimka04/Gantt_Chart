<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_id',
        'amount',
        'type',
        'status',
        'notes'
    ];

    // Hubungan: Satu derma milik satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donor()
    {
        return $this->morphTo();
    }
}