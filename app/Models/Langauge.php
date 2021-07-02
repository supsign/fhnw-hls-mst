<?php

namespace App\Models;

class Langauge extends BaseModel
{
    public function courses()
    {
    	return $this->hasMany(Course::class);
    }
}
