<?php

namespace App\Services\Student;

use App\Models\Student;

class StudentCreditService
{
    public function getCreditsAsString(Student $student = null): string
    {
        if (!$student || $student->completions()->count()) {
            return '-';
        }

        return (string)$this->getCredits($student);
    }

    protected function getCredits(Student $student): int 
    {
        $credits = 0;

        /** @var $completion Completion * */
        foreach ($student->completions as $completion) {
            if ($completion->student->studyFieldYear && !$completion->studyFieldYears->contains($completion->student->studyFieldYear)) {
                continue;
            }

            // bestanden
            if ($completion->completion_type_id === 2) {
                $credits += $completion->credits;
                continue;
            }

            // angerechnet
            if ($completion->completion_type_id === 4) {
                $credits += $completion->credits;
            }
        }

        return $credits;
    }
}