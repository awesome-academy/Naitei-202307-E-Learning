<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
