<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Major extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'image',
        'duration_years',
        'subjects',
        'is_active',
    ];

    protected $casts = [
        'subjects'       => 'array',
        'is_active'      => 'boolean',
        'duration_years' => 'integer',
    ];

    // ── Relationships ─────────────────────────────────────────────────────────

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function universities(): BelongsToMany
    {
        return $this->belongsToMany(University::class, 'major_university')
                    ->withTimestamps();
    }

    public function careerPaths(): HasMany
    {
        return $this->hasMany(CareerPath::class);
    }

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favorable');
    }
}