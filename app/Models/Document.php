<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'name',
        'title',
        'file_path',
        'type',        // cv, certificate, portfolio, other
        'description',
    ];

    // Accessor for full URL
    public function getUrlAttribute()
    {
        return $this->file_path ? asset('storage/' . $this->file_path) : null;
    }

    public static function type(string $key)
    {
        return static::where('type', $key)->get();
    }
}
