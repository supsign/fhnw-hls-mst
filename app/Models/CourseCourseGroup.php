<?php

namespace App\Models;

class CourseCourseGroup extends BaseModel
{
	protected $table = 'course_course_group';

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courseGroup()
    {
        return $this->belongsTo(CourseGroup::class);
    }

    public function startSemester()
    {
    	return $this->belongsTo(Semester::class, 'start_semester_id');
    }
}
