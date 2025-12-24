<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'event_date', 'capacity', 'venue'];
    protected $dates = ['event_date'];

    
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'registrations', 'event_id', 'participant_id');
    }
}
