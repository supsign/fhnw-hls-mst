<?php

namespace App\Http\Controllers;

use App\Models\CrossQualification;
use App\Models\CrossQualificationYear;
use App\Models\StudyField;
use App\Models\StudyFieldYear;
use App\Services\Faq\FrequentlyAskedQuestionService;
use App\Services\User\PermissionAndRoleService;

class HomeController extends Controller
{
    public function __construct(protected PermissionAndRoleService $permissionAndRoleService)
    {}

    public function test()
    {
        $studyFieldMap = [
            37 => 15,
            38 => 14,
            39 => 13,
            40 => 11,
            41 => 12,
            42 => 8,
            43 => 15,
            // 44 => 9
        ];

        $studyFields = StudyField::whereIn('id', $studyFieldMap)
            ->with('studyFieldYears.crossQualificationYears')
            ->get();

        foreach ($studyFields AS $studyField) {
            $studyFieldYear = $studyField
                ->studyFieldYears
                ->sortByDesc('id')
                ->first();

            foreach ($studyFieldYear->crossQualificationYears AS $crossQualificationYear) {
                $newStudyFieldYear = StudyFieldYear::where('study_field_id', array_search($studyFieldYear->study_field_id, $studyFieldMap))->first();
                $newCrossQualitifactonYear = $crossQualificationYear->replicate();
                $newCrossQualitifactonYear->study_field_year_id = $newStudyFieldYear->id;
                $newCrossQualitifactonYear->save();

                foreach ($crossQualificationYear->courseCrossQualificationYears AS $courseCrossQualificationYear) {
                    $newCourseCrossQualificationYear = $courseCrossQualificationYear->replicate();
                    $newCourseCrossQualificationYear->cross_qualification_year_id = $newCrossQualitifactonYear->id;
                    $newCourseCrossQualificationYear->save();
                }
            }
        }

        return 1;





        $crossQualitifactonYears = [];

        foreach ($crossQualitifactonYears AS $crossQualitifactonYear) {
            $newStudyFieldYear = null;

            dump(
                $crossQualitifactonYear->cross_qualification_id,
                $crossQualitifactonYear->study_field_year_id,
            );
            echo '<hr/>';
            // continue;

            $newCrossQualitifactonYear = $crossQualitifactonYear->replicate();
            $newCrossQualitifactonYear->study_field_year_id = $newStudyFieldYear->id;

            dump(
                $newCrossQualitifactonYear->cross_qualification_id,
                $newCrossQualitifactonYear->study_field_year_id,
                $newStudyFieldYear,
                array_search($crossQualitifactonYear->studyFieldYear->study_field_id, $studyFieldMap),
            );
            echo 'next one <br/>';
            continue;

            // $newCrossQualitifactonYear->save();

            foreach ($crossQualitifactonYear->courseCrossQualificationYears AS $courseCrossQualificationYear) {
                $newCourseCrossQualificationYear = $courseCrossQualificationYear->replicate();
                $newCourseCrossQualificationYear->cross_qualification_year_id = $newCrossQualitifactonYear->id;
                // $newCourseCrossQualificationYear->save();
            }
        }

        return 1;
    }

    public function index()
    {
        $this->permissionAndRoleService->canShowAppOrAbort();

        return view('pages.home');
    }

    public function faq(FrequentlyAskedQuestionService $faqService)
    {
        $this->permissionAndRoleService->canShowAppOrAbort();

        return view('pages.faq', ['faqs' => $faqService->getAll()]);
    }
}
