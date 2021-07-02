<?php

namespace App\Models;

class SkillStundent extends BaseModel
{
    protected $table = 'skill_student';

    public function event()
    {
    	return $this->belongsTo(Event::class);
    }

    public function skill()
    {
    	return $this->belongsTo(Skill::class);
    }

    public function student()
    {
    	return $this->belongsTo(Student::class);
    }    
}
