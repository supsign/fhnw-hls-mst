<?php

namespace App\Services\Semester;

use App\Models\Semester;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;
use Carbon\Carbon;
use Exception;

class SemesterService extends BaseModelService
{
    protected int $cutOffYearMin = 2017;
    protected int $cutOffYearMax = 2100;

    use FirstOrCreateTrait {
        firstOrCreate AS protected firstOrCreateTrait;
    }

    protected $semesterStartDateHs = '01.09.';
    protected $semesterStartDateFs = '01.02.';

    public function __construct(protected Semester $model)
    {
        parent::__construct($model);
    }

    public function firstOrcreateByYear(int $year, bool $isHs = true): ?Semester
    {
        if ($year >= $this->cutOffYearMax || $year <= $this->cutOffYearMin) {
            throw new Exception('year value "'.$year.'" is out of range');
        }

        $startDate = ($isHs ? $this->semesterStartDateHs : $this->semesterStartDateFs).$year;
        $previousSemester = $year <= 2018 ? null : $this->firstOrcreateByYear($isHs ? $year : $year - 1, !$isHs);

        return $this->firstOrCreateTrait([
            'year' => $year,
            'is_hs' => $isHs,
        ], [
            'start_date' => ($isHs ? '01.09.' : '01.02.').$year,
            'previous_semester_id' => $this->firstOrcreateByYear($isHs ? $year : $year - 1, !$isHs)?->id,
        ]);
    }

    public function countSemestersFromSemesterToNow(Semester $semester): int
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
    }
}
