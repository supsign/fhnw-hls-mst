<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class StudyFieldYearCollection extends Collection
{
    public function getStudyFields()
    {
        return $this->pluck('studyField')->unique();
    }

    public function getCourseCourseGroupYears(): SupportCollection
    {
        return $this->getCourseGroupYears()->pluck('courseCourseGroupYears')->flatten(1)->unique();
    }

    public function getCourseGroupYears(): SupportCollection
    {
        return $this->pluck('courseGroupYears')->flatten(1)->unique();
    }
}
