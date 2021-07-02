<?php

namespace App\Models;

class StudyProgram extends BaseModel
{
    public function studyFields()
    {
    	return $this->hasMany(StudyField::class);
    }
}
