<?php

namespace App\Models;

class CourseGroup extends BaseModel
{
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function courseCourseGroups()
    {
        return $this->hasMany(CourseCourseGroup::class);
    }

    public function studyField()
    {
        return $this->belongsTo(StudyField::class);
    }
}
