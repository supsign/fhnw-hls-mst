<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

class StudyFieldYearCollection extends Collection
{
    public function getStudyFields()
    {
        return $this->pluck('studyField')->unique();
    }

    public function getCourseCourseGroupYears(): Collection
    {
        return $this->getCourseGroupYears()->pluck('courseCourseGroupYears')->flatten(1)->unique();
    }

    public function getCourseGroupYears(): Collection
    {
        return $this->pluck('courseGroupYears')->flatten(1)->unique();
    }
}
