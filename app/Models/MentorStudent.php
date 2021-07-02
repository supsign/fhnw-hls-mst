<?php

namespace App\Models;

class MentorStudent extends BaseModel
{
    protected $table = 'mentor_student';

    public function mentor()
    {
    	return $this->belongsTo(Mentor::class);
    }

    public function student()
    {
    	return $this->belongsTo(Student::class);
    }
}
