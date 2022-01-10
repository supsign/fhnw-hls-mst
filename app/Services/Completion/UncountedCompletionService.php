<?php

namespace App\Services\Completion;

use App\Models\Completion;
use App\Models\Student;
use App\Models\StudyFieldYear;
use Illuminate\Support\Collection;


class UncountedCompletionService
{
    public function __construct(protected CourseCompletionService $courseCompletionService)
    {
    }

    public function getSuccessfullCompletionsOfOtherStudyFields(Student $student, StudyFieldYear $studyFieldYear): Collection
    {
        $completions = $student->completions;

        $successfullCompletions = $completions->filter(function (Completion $completion) {
            return $completion->completion_type_id === 2 || $completion->completion_type_id === 4;
        });
        $coursesOfStudyField = $studyFieldYear->courses;

        return $successfullCompletions->filter(function (Completion $completion) use ($coursesOfStudyField) {
            return !$coursesOfStudyField->contains($completion->courseYear->course_id);
        });
    }
}

