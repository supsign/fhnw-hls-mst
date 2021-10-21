<?php

namespace App\Models;

/**
 * @mixin IdeHelperCourseYear
 */
class CourseYear extends BaseModel
{
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

    public function skillStudents()
    {
        return $this->hasMany(SkillStundent::class);
    }
}
