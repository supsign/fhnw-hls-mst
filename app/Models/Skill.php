<?php

namespace App\Models;

class Skill extends BaseModel
{
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function courseSkill()
    {
        return $this->hasMany(CourseSkill::class);
    }

    public function skillStudent()
    {
        return $this->hasMany(SkillStundent::class);
    }

    public function taxonomy()
    {
        return $this->belongsTo(Taxonomy::class);
    }
}
