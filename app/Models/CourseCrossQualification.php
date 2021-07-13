<?php

namespace App\Models;

class CourseCrossQualification extends BaseModel
{
	protected $table = 'course_cross_qualification';

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function crossQualification()
    {
        return $this->belongsTo(CrossQualification::class);
    }

    public function beginSemester()
    {
    	return $this->belongsTo(Semester::class, 'begin_semester_id');
    }
}