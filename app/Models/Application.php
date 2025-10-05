<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $guarded = [];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
