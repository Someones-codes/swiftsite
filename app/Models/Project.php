<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'short_description', 'image_path',
        'tech_stack', 'live_url', 'github_url', 'is_featured', 'sort_order'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    // Helper to get image URL or a placeholder
    public function getImageUrlAttribute(): string
    {
        return $this->image_path
            ? asset('storage/' . $this->image_path)
            : asset('images/project-placeholder.jpg');
    }
}