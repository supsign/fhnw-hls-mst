<?php

namespace App\Models;

/**
 * @mixin IdeHelperStudent
 */
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

    public function beginSemester()
    {
        return $this->belongsTo(Semester::class, 'begin_semester_id');
    }

    public function studyFieldYear()
    {
        return $this->belongsTo(StudyFieldYear::class);
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

    public function user()
    {
        return $this->hasOne(User::class);
    }


}
