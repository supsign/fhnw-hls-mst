<?php

namespace App\Models;

class Course extends BaseModel
{
    public function assessments()
    {
    	return $this->hasMany(Assessment::class);
    }
}
