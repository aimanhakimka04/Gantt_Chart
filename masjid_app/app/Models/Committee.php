<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Committee extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'committees';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // 'admin' atau 'moderator'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * PEMBETULAN: Check role sebenar dari database
     */
    public function isAdmin(): bool
    {
        // Hanya return true jika role dia 'admin'
        return $this->role === 'admin';
    }

    public function isModerator(): bool
    {
        return $this->role === 'moderator';
    }

    public function getRoleDisplayAttribute(): string
    {
        return ucfirst($this->role);
    }

    /**
     * TAMBAHAN: Untuk membolehkan Committee menderma (Polymorphic)
     */
    public function donations()
    {
        return $this->morphMany(Donation::class, 'donor');
    }
}