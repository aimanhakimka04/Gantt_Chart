<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = ['participant_id', 'event_id', 'status'];

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}