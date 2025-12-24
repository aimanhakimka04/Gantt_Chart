<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = ['committee_id', 'event_id', 'description', 'status'];

    public function committee()
    {
        return $this->belongsTo(Committee::class, 'committee_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
