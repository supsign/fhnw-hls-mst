<?php

namespace App\Models;

/**
 * @mixin IdeHelperLesson
 */
class Lesson extends BaseModel
{
    public function courseYear()
    {
    	return $this->belongsTo(CourseYear::class);
    }
}