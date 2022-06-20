<?php

namespace App\Services\CourseGroupYear;

use App\Http\Requests\CourseGroupYear\PostRequest;
use App\Models\CourseGroup;
use App\Models\CourseGroupYear;
use App\Models\Student;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateOrCreateTrait;
use App\Services\Completion\CourseCompletionService;
use App\Services\CourseCourseGroupYear\CourseCourseGroupYearService;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class CourseGroupYearService extends BaseModelService
{
    use UpdateOrCreateTrait;

    public function __construct(protected CourseGroupYear $model, protected CourseCompletionService $courseCompletionService, protected CourseCourseGroupYearService $courseCourseGroupYearService)
    {
        parent::__construct($model);
    }

    public function createFromPostRequest(PostRequest $request): CourseGroupYear
    {
        if (!empty($request->safe()->course_group_id)) {
            $courseGroup = CourseGroup::find($request->safe()->course_group_id);
        } elseif (!empty($request->safe()->course_group_name)) {
            $courseGroup = CourseGroup::create([
                'name' => $request->safe()->course_group_name,
            ]);
        } else {
            throw new UnprocessableEntityHttpException('no course group found');
        }

        return CourseGroupYear::create([
            'amount_to_pass' => $request->safe()->amount_to_pass ?? null,
            'credits_to_pass' => $request->safe()->credits_to_pass ?? null,
            'course_group_id' => $courseGroup->id,
            'study_field_year_id' => $request->safe()->study_field_year_id,
        ])->load('courseGroup');
    }

    public function isSuccessfullyCompleted(CourseGroupYear $courseGroupYear, Student $student): bool
    {
        return $this->getCredits($courseGroupYear, $student) >= $courseGroupYear->credits_to_pass;
    }

    public function getCredits(CourseGroupYear $courseGroupYear, Student $student): int
    {
        $credits = 0;

        foreach ($courseGroupYear->courses as $course) {
            $credits += $this->courseCompletionService->getCredits($course, $student);
        }

        return $credits;
    }

    public function hasVisitedAtLeastOneCourse(CourseGroupYear $courseGroupYear, Student $student): bool
    {
        foreach ($courseGroupYear->courses as $course) {
            if ($this->courseCompletionService->courseIsSuccessfullyCompleted($course, $student)) {
                return true;
            }

            if ($this->courseCompletionService->courseHasFailedCompletions($course, $student)) {
                return true;
            }
        }

        return false;
    }

    public function setCreditToPass(CourseGroupYear $courseGroupYear, int $credits_to_pass = null)
    {
        $courseGroupYear->credits_to_pass = $credits_to_pass;
        $courseGroupYear->save();

        return $courseGroupYear;
    }
}
