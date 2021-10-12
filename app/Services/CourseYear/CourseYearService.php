<?php

namespace App\Services\CourseYear;

use App\Models\Course;
use App\Models\CourseYear;
use App\Models\Semester;
use App\Services\Base\BaseModelService;

class CourseYearService extends BaseModelService
{
    public function __construct(protected CourseYear $model)
    {
        parent::__construct($model);
    }

    public function createCourseYear(Course $course, Semester $semester, int $eventoAnlassId = null): CourseYear
    {
        /* @var $latestCourseYear CourseYear */
        $latestCourseYear = $course->courseYears->load('semester')->sortByDesc('semester.start_date')->first();

        $courseYear = $this->model::create([
            'semester_id' => $semester->id,
            'course_id' => $course->id,
            'evento_anlass_id' => $eventoAnlassId,
        ]);

        if ($latestCourseYear) {
            return $this->copyCourseDataFromCourseYear($courseYear, $latestCourseYear);
        }

        return $this->copyCourseDataFromCourse($courseYear, $course);
    }

    protected function copyCourseDataFromCourseYear(CourseYear $targetCourseYear, CourseYear $sourceCourseYear): CourseYear
    {
        $targetCourseYear->name = $sourceCourseYear->name;
        $targetCourseYear->save();

        return $targetCourseYear;
    }

    protected function copyCourseDataFromCourse(CourseYear $targetCourseYear, Course $sourceCourse): CourseYear
    {
        $targetCourseYear->name = $sourceCourse->name;
        $targetCourseYear->save();

        return $targetCourseYear;
    }
}
