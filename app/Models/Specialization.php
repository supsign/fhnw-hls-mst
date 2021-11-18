<?php

namespace App\Models;

/**
 * @mixin IdeHelperSpecialization
 */
class Specialization extends BaseModel
{
    public function studyField()
    {
        return $this->belongsTo(StudyField::class);
    }
}
