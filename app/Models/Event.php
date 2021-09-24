<?php

namespace App\Models;

/**
 * @mixin IdeHelperEvent
 */
class Event extends BaseModel
{
    public function completions()
    {
        return $this->hasMany(Completion::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function skillStudent()
    {
        return $this->hasMany(SkillStundent::class);
    }

    public function skillStudentSkills()
    {
        return $this->hasManyThrough(
            Skill::class,
            SkillStundent::class,
            'event_id',
            'id',
            'id',
            'skill_id',
        );
    }

    public function skillStudentStudents()
    {
        return $this->hasManyThrough(
            Student::class,
            SkillStundent::class,
            'event_id',
            'id',
            'id',
            'student_id',
        );
    }
}
