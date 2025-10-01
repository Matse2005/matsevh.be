<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public static function key(string $key): Profile
    {
        return static::where('key', $key)->first();
    }
}
