<?php

namespace App\Models;

class Student extends BaseModel
{
    public function completions()
    {
    	return $this->hasMany(Completion::class);
    }

    public function mentors()
    {
        return $this->belongsToMany(Mentor::class);
    }

    public function mentorStudent()
    {
        return $this->hasMany(MentorStudent::class);
    }

    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }

    public function startSemester()
    {
        return $this->belongsTo(Semester::class, 'start_semester_id');
    }

    public function studyField()
    {
        return $this->belongsTo(StudyField::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
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
            'student_id',
            'id',
            'id',
            'event_id',
        );
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
