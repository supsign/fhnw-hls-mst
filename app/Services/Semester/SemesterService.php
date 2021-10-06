<?php

namespace App\Services\Semester;

use App\Models\Semester;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;
use Carbon\Carbon;

class SemesterService extends BaseModelService
{
    use FirstOrCreateTrait {
        firstOrCreate AS protected firstOrCreateTrait;
    }

    protected $semesterStartDateHs = '01.09.';
    protected $semesterStartDateFs = '01.02.';

    public function __construct(protected Semester $model)
    {
        parent::__construct($model);
    }

    public function firstOrcreateByYear(int $year, bool $isHs = true): Semester
    {
        $startDate = ($isHs ? $this->semesterStartDateHs : $this->semesterStartDateFs).$year;
        $previousSemester = $year <= 2018 ? null : $this->firstOrcreateByYear($isHs ? $year : $year - 1, !$isHs);

        return $this->firstOrCreateTrait([
            'year' => $year,
            'is_hs' => $isHs,
        ], [
            'start_date' => $startDate,
            'previous_semester_id' => $previousSemester?->id,
        ]);
    }

    public function countSemesterFromSemesterToNow(Semester $semester): int
    {
        $today = Carbon::today();

        $currentSemester = $this->firstOrcreateByYear(
            $today->year,
            Carbon::parse($this->semesterStartDateHs.$today->year)->isPast()
        );

        $i = 1;

        if ($currentSemester->id === $semester->id) {
            return $i;
        }

        while (true) {
            $i++;

            if (!$currentSemester->previousSemester) {
                return $i;
            }

            if ($currentSemester->previousSemester->id === $semester->id) {
                return $i;
            }

            $currentSemester = $currentSemester->previousSemester;
        }

        return $i;
    }
}
