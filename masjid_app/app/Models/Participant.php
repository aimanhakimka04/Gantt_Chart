<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Participant extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'participants';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the registrations for the participant.
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class, 'participant_id');
    }

    /**
     * Get the events the participant is registered for.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'registrations', 'participant_id', 'event_id');
    }

    /**
     * Get the service requests for the participant.
     */
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'participant_id');
    }
    public function donations()
    {
        return $this->morphMany(Donation::class, 'donor');
    }
}


