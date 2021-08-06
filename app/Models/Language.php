<?php

namespace App\Models;

class Language extends BaseModel
{
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
