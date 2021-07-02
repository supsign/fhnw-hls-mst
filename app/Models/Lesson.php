<?php

namespace App\Models;

class Lesson extends BaseModel
{
    public function event()
    {
    	return $this->belongsTo(Event::class);
    }
}