<?php

namespace App\Services\Semester;

use App\Models\Semester;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class SemesterService extends BaseModelService
{
    protected int $cutOffYearMin = 2017;
    protected int $cutOffYearMax = 2100;

    use FirstOrCreateTrait {
        firstOrCreate as protected firstOrCreateTrait;
    }

    protected $semesterStartDateHs = '01.09.';
    protected $semesterStartDateFs = '01.02.';

    public function __construct(protected Semester $model)
    {
        parent::__construct($model);
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

    public function firstOrCreateByYear(int $year, bool $isHs = true): Semester
    {
        if ($year >= $this->cutOffYearMax) {
            throw new Exception('year value "'.$year.'" is out of range');
        }

        $previousSemester = $year <= $this->cutOffYearMin ? null : $this->firstOrCreateByYear($isHs ? $year : $year - 1, !$isHs);

        return $this->firstOrCreateTrait([
            'year' => $year,
            'is_hs' => $isHs,
        ], [
            'start_date' => ($isHs ? $this->semesterStartDateHs : $this->semesterStartDateFs).$year,
            'previous_semester_id' => $previousSemester?->id,
        ]);
    }

    public function getCurrentAndFutureSemesters(): Collection
    {
        $result = $this->model::whereDate('start_date', '>', Carbon::now())->orderBy('start_date')->get();

        return $result->push($result->first()->previousSemester)->sortBy('start_date');
    }

    public function getSemesterFromEventoNumber(string $number): Semester
    {
        $year = 2000 + substr($number, 2, 2);   //  fix before 2100
        $isHs = substr($number, 4, 2) === 'HS';

        return $this->firstOrCreateByYear($year, $isHs);
    }

    public function getSemesterByStartAndNumber(Semester $startSemester, int $number = 1): ?Semester
    {
        $targetSemester = $startSemester;
        for ($i = 1; $i < $number; $i++) {
            $targetSemester = $targetSemester->nextSemester;
            if (!$targetSemester) {
                break;
            }
        }

        return $targetSemester;
    }
}
