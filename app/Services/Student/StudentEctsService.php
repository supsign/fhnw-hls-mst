<?php

namespace App\Services\Student;

use App\Models\Completion;
use App\Models\Student;
use Illuminate\Support\Collection;

class StudentEctsService
{
    public function getPointsAsString(Student $student = null): string
    {
        if (!$student) {
            return '-';
        }
        $completions = $student->completions;
        $countCompletions = $completions->count();

        if ($countCompletions === 0) {
            return '-';
        }

        return (string)$this->getPoints($completions);
    }

    public function getPoints(Collection $completions): int
    {
        $points = 0;

        /** @var $completion Completion * */
        foreach ($completions as $completion) {
            // bestanden
            if ($completion->completion_type_id === 2) {
                $points += $completion->credits;
                continue;
            }

            // angerechnet
            if ($completion->completion_type_id === 4) {
                $points += $completion->credits;
            }
        }

        return $points;
    }
}
