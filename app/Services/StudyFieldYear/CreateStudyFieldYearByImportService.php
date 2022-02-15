<?php

namespace App\Services\StudyFieldYear;

use App\Models\StudyField;
use App\Models\StudyFieldYear;
use App\Services\Base\BaseModelService;
use App\Services\CourseGroupYear\CourseGroupYearService;
use App\Services\CourseGroupYear\CreateCourseGroupYearByLatestService;
use App\Services\CrossQualificationYear\CreateCrossQualificationYearByLatestService;
use App\Services\Evento\Traits\GetByEventoId;
use App\Services\SpecializationYear\CreateSpecializationYearByLatestService;
use App\Services\StudyField\StudyFieldService;
use Exception;

/**
 * @method StudyFieldYear getByEventoId(int $eventoId)
 */
class CreateStudyFieldYearByImportService extends BaseModelService
{
    use GetByEventoId;

    public function __construct(
        protected StudyFieldYear $model,
        protected StudyFieldService $studyFieldService,
        protected CourseGroupYearService $courseGroupYearService,
        protected CreateCourseGroupYearByLatestService $createCourseGroupYearByLatestService,
        protected CreateSpecializationYearByLatestService $createSpecializationYearByLatestService,
        protected CreateCrossQualificationYearByLatestService $createCrossQualificationYearByLatestService,
        protected StudyFieldYearService $studyFieldYearService,
    ) {
        parent::__construct($model);
    }

    /**
     * If the StudyFieldYears already exists no action will be performed.
     *
     * @param  int  $eventoId
     * @param  StudyField  $studyField
     * @param  string  $eventoNumber
     * @return StudyFieldYear
     *
     * @throws Exception
     */
    public function createNewByReImport(int $eventoId, StudyField $studyField, string $eventoNumber): StudyFieldYear
    {
        $studyFieldYear = $this->studyFieldYearService->getByEventoId($eventoId);

        if ($studyFieldYear) {
            return $studyFieldYear;
        }

        $beginSemester = $this->studyFieldService->getSemesterFromEventoNumber($eventoNumber);

        $lastStudyFieldYear = $this->getLatestStudyFieldYear($studyField);

        if (!$lastStudyFieldYear) {
            return $studyFieldYear;
        }

        $studyFieldYear = $this->model::create([
            'evento_id' => $eventoId,
            'study_field_id' => $studyField->id,
            'begin_semester_id' => $beginSemester->id,

        ]);
        activity('info')
            ->causedBy($studyFieldYear)
            ->log('StudyField Created');

        $studyFieldYear->update([
            'assessment_id' => $lastStudyFieldYear->assessment_id,
            'recommendation_id' => $lastStudyFieldYear->recommendation_id,
            'is_specialization_mandatory' => $lastStudyFieldYear->is_specialization_mandatory,
        ]);

        foreach ($lastStudyFieldYear->courseGroupYears as $courseGroupYear) {
            try {
                $this->createCourseGroupYearByLatestService->createByLatest($courseGroupYear, $studyFieldYear);
            } catch (Exception $e) {
                activity('error')
                    ->causedBy($studyFieldYear)
                    ->log($e->getMessage());
            }
        }

        foreach ($lastStudyFieldYear->specializationYears as $specializationYear) {
            $this->createSpecializationYearByLatestService->createByLatest($specializationYear, $studyFieldYear);
        }

        foreach ($lastStudyFieldYear->crossQualificationYears as $crossQualificationYear) {
            $this->createCrossQualificationYearByLatestService->createByLatest($crossQualificationYear, $studyFieldYear);
        }

        return $studyFieldYear;
    }

    protected function getLatestStudyFieldYear(StudyField $studyField): ?StudyFieldYear
    {
        return $this->model::where(['study_field_id' => $studyField->id])->with('beginSemester')->get()->sortByDesc('beginSemester.year')->first();
    }
}
