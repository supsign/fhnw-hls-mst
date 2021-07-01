<?php

namespace App\Models;

class Student extends BaseModel
{
    public function completions()
    {
    	return $this->hasMany(Completion::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
