<?php

namespace App\Models;

/**
 * @mixin IdeHelperCompletion
 */
class Completion extends BaseModel
{
    public function courseYear()
    {
    	return $this->belongsTo(CourseYear::class);
    }

    public function student()
    {
    	return $this->belongsTo(Student::class);
    }
}
