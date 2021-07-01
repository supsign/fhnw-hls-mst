<?php

namespace App\Models;

class Completion extends BaseModel
{
    public function event()
    {
    	return $this->belongsTo(Event::class);
    }

    public function student()
    {
    	return $this->belongsTo(Student::class);
    }
}
