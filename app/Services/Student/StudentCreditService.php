<?php

namespace App\Services\Student;

use App\Models\Student;
use Illuminate\Support\Collection;

class StudentCreditService
{
    public function getCreditsAsString(Student $student = null): string
    {
        if (!$student) {
            return '-';
        }
        $completions = $student->completions;
        $countCompletions = $completions->count();

        if ($countCompletions === 0) {
            return '-';
        }

        return (string)$this->getCredits($completions);
    }

    public function getCredits(Collection $completions): int
    {
        $credits = 0;

        /** @var $completion Completion * */
        foreach ($completions as $completion) {
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
