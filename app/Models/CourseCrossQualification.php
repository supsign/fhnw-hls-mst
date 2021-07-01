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

    public function startSemester()
    {
    	return $this->belongsTo(Semester::class, 'start_semester_id');
    }
}