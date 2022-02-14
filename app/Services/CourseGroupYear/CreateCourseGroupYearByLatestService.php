<?php

namespace App\Services\CourseGroupYear;

use App\Models\CourseGroupYear;
use App\Models\StudyFieldYear;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateOrCreateTrait;
use App\Services\CourseCourseGroupYear\CourseCourseGroupYearService;
use Exception;

class CreateCourseGroupYearByLatestService extends BaseModelService
{
    use UpdateOrCreateTrait;

    public function __construct(protected CourseGroupYear $model, protected CourseCourseGroupYearService $courseCourseGroupYearService)
    {
        parent::__construct($model);
    }

    /**
     * @throws Exception
     */
    public function createByLatest(CourseGroupYear $latestCourseGroupYear, StudyFieldYear $studyFieldYear): ?CourseGroupYear
    {
        if ($latestCourseGroupYear->studyFieldYear->study_field_id !== $studyFieldYear->study_field_id) {
            throw new Exception('change of studyField by createByLatest now allowed');
        }

        $courseGroupYear = $this->model::create([
            'course_group_id' => $latestCourseGroupYear->course_group_id,
            'study_field_year_id' => $studyFieldYear->id,
            'amount_to_pass' => $latestCourseGroupYear->amount_to_pass,
            'credits_to_pass' => $latestCourseGroupYear->credits_to_pass
        ]);

        foreach ($latestCourseGroupYear->courseCourseGroupYears as $courseCourseGroupYear) {
            $this->courseCourseGroupYearService->add($courseCourseGroupYear->course, $courseGroupYear);
        }

        return $courseGroupYear;


    }
}
