<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'technologies', // comma-separated or JSON
        'github_url',
        'demo_url',
        'image',
        'order',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'technologies' => 'array'
        ];
    }

    // // Accessor to get technologies as array if stored as JSON
    // public function getTechnologiesArrayAttribute()
    // {
    //     return $this->technologies ? explode(',', $this->technologies) : [];
    // }
}
