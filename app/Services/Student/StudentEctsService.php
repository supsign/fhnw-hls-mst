<?php

namespace App\Services\Student;

use App\Models\Completion;
use App\Models\Student;
use Illuminate\Support\Collection;

class StudentEctsService
{
    public function getPointsAsString(Student $student): string
    {
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
                $pooints += $completion->credits;
                continue;
            }

            // angerechnet
            if ($completion->completion_type_id === 4) {
                $pooints += $completion->credits;
            }
        }

        return $points;
    }
}
