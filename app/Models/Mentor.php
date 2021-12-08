<?php

namespace App\Models;

/**
 * @mixin IdeHelperMentor
 */
class Mentor extends BaseModel
{
    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }

    public function mentorStudent()
    {
        return $this->hasMany(MentorStudent::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function studyFields()
    {
        return $this->belongsToMany(StudyField::class);
    }

    public function mentorStudyFields()
    {
        return $this->hasMany(MentorStudyField::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
