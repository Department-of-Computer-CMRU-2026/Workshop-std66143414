<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    /** @use HasFactory<\Database\Factories\ActivityFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'speaker',
        'location',
        'total_seats',
    ];

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function getRegisteredCountAttribute(): int
    {
        return $this->registrations()->count();
    }

    public function getAvailableSeatsAttribute(): int
    {
        return max(0, $this->total_seats - $this->registered_count);
    }

    public function getIsFullAttribute(): bool
    {
        return $this->available_seats <= 0;
    }

    public function canRegister(?User $user): bool
    {
        if (!$user)
            return false;

        // Already registered?
        if ($this->registrations()->where('user_id', $user->id)->exists()) {
            return false;
        }

        // Is full?
        if ($this->is_full) {
            return false;
        }

        // Limit 3 per student
        if ($user->registrations()->count() >= 3) {
            return false;
        }

        return true;
    }
}
