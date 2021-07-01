<?php

namespace App\Models;

class Plannings extends BaseModel
{
    public function crossQualification()
    {
    	return $this->belongsTo(CrossQualification::class);
    }

    public function mentor()
    {
    	return $this->belongsTo(Mentor::class);
    }

    public function specialization()
    {
    	return $this->belongsTo(Specialization::class);
    }

    public function student()
    {
    	return $this->belongsTo(Student::class);
    }
}
