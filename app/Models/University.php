<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class University extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'logo', 'cover_image',
        'location', 'type', 'ranking', 'country', 'city',
        'website', 'admission_requirements', 'is_active'
    ];

    protected $casts = [
        'ranking' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function majors()
    {
        return $this->belongsToMany(Major::class, 'major_university')
                    ->withTimestamps();
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorable');
    }

    public function isFavoritedBy($userId)
    {
        return $this->favorites()->where('user_id', $userId)->exists();
    }
}