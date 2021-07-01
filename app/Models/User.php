<?php

namespace App\Models;

class User extends BaseModel
{
    public function mentor()
    {
    	return $this->belongsTo(Mentor::class);
    }

    public function student()
    {
    	return $this->belongsTo(Student::class);
    }
}
