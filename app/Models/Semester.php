<?php

namespace App\Models;

class Semester extends BaseModel
{
        public function assessments()
    {
    	return $this->hasMany(Assessment::class, 'start_semester_id');
    }
}
