<?php

namespace App\Services\Student;

use App\Models\Completion;
use App\Models\Student;

class StudentCreditService
{
    protected array $passedCompletionTypes = [2, 4];

    public function getCreditsAsString(Student $student = null): string
    {
        if (!$student || !$student->completions()->count()) {
            return '-';
        }

        return (string)$this->getCredits($student);
    }

    protected function getCredits(Student $student): int
    {
        $credits = 0;

        if (!$student->studyFieldYear?->courses->count()) {
            return $credits;
        }

        foreach ($student->completions as $completion) {
            if (!$student->studyFieldYear->courses->contains($completion->courseYear->course)) {
                continue;
            }

            if (!in_array($completion->completion_type_id, $this->passedCompletionTypes)) {
                continue;
            }

            $credits += $completion->credits;
        }

        foreach (
            $student
                ->completions
                ->filter(fn (Completion $completion) => $completion->course_group_id && in_array($completion->completion_type_id, $this->passedCompletionTypes))
            AS $otherCompletions
        ) {
            $credits += $otherCompletions->credits;
        }

        return $credits;
    }
}
