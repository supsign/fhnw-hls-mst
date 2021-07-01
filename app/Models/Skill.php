<?php

namespace App\Models;

class Skill extends BaseModel
{
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function skillStudent()
    {
        return $this->hasMany(SkillStundent::class);
    }

    public function skillStudentEvents()
    {
        return $this->hasManyThrough(
            Event::class,
            SkillStundent::class,
            'skill_id',
            'id',
            'id',
            'event_id',
        );
    }
}
