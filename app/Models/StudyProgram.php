<?php

namespace App\Models;

/**
 * @mixin IdeHelperStudyProgram
 */
class StudyProgram extends BaseModel
{
    public function studyFields()
    {
    	return $this->hasMany(StudyField::class);
    }
}
