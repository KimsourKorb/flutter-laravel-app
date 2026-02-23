<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Major extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'category_id', 'image',
        'duration_years', 'subjects', 'is_active'
    ];

    protected $casts = [
        'subjects' => 'array',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function universities()
    {
        return $this->belongsToMany(University::class, 'major_university')
                    ->withTimestamps();
    }

    public function careerPaths()
    {
        return $this->hasMany(CareerPath::class);
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorable');
    }
}