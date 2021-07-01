<?php

namespace App\Models;

class Event extends BaseModel
{
    public function completions()
    {
    	return $this->hasMany(Completion::class);
    }
}
