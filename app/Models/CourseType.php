<?php

namespace App\Models;

/**
 * @mixin IdeHelperCourseType
 */
class CourseType extends BaseModel
{
    public function courses()
    {
    	return $this->hasMany(Course::class);
    }
}
