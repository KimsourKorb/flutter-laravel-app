<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class University extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'logo', 'cover_image', 'images',
        'location', 'type', 'ranking', 'country', 'city',
        'website', 'admission_requirements', 'is_active', 'established_year',
    ];

    protected $casts = [
        'ranking'          => 'decimal:2',
        'is_active'        => 'boolean',
        'established_year' => 'integer',
        'images'           => 'array',   // stored as JSON, returned as array
    ];

    public function majors(): BelongsToMany
    {
        return $this->belongsToMany(Major::class, 'major_university')
                    ->with('category')
                    ->withTimestamps();
    }

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favorable');
    }

    public function isFavoritedBy($userId): bool
    {
        return $this->favorites()->where('user_id', $userId)->exists();
    }
}