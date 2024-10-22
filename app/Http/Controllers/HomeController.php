<?php

namespace App\Http\Controllers;

use App\Models\CrossQualification;
use App\Models\CrossQualificationYear;
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

        // foreach (CrossQualification::all() AS $crossQualification) {
        //     if (!in_array($crossQualification->study_field_id, $studyFieldMap)) {
        //         continue;
        //     }

        //     $copy = $crossQualification->replicate();
        //     $copy->study_field_id = array_search($crossQualification->study_field_id, $studyFieldMap);
        //     $copy->janis_id = null;
        //     $copy->save();
        // }

        $
        $crossQualitifactonYears = CrossQualificationYear::with('studyFieldYear')->get();
        $studyFieldYears = StudyFieldYear::with('studyField')
            ->whereIn('study_field_id', array_keys($studyFieldMap))
            ->get();

        foreach ($crossQualitifactonYears AS $crossQualitifactonYear) {
            if (!in_array($crossQualitifactonYear->studyFieldYear->study_field_id, $studyFieldMap)) {
                continue;
            }

            $newStudyFieldYear = $studyFieldYears->first(
                fn (StudyFieldYear $sfy): bool => $sfy->study_field_id === array_search($crossQualitifactonYear->studyFieldYear->study_field_id, $studyFieldMap)
            );

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

            $newCrossQualitifactonYear->save();

            foreach ($crossQualitifactonYear->courseCrossQualificationYears AS $courseCrossQualificationYear) {
                $newCourseCrossQualificationYear = $courseCrossQualificationYear->replicate();
                $newCourseCrossQualificationYear->cross_qualification_year_id = $newCrossQualitifactonYear->id;
                $newCourseCrossQualificationYear->save();
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
