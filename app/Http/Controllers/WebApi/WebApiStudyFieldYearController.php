<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudyFieldYear\PatchStudyFieldYearRequest;
use App\Models\StudyFieldYear;
use App\Services\Assessment\AssessmentService;
use App\Services\Recommendation\RecommendationService;
use App\Services\StudyFieldYear\StudyFieldYearService;
use App\Services\User\PermissionAndRoleService;

class WebApiStudyFieldYearController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
    ) {
    }

    public function get(StudyFieldYear $studyFieldYear): StudyFieldYear
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return $studyFieldYear;
    }

    public function patch(
        PatchStudyFieldYearRequest $patchStudyFieldYearRequest,
        StudyFieldYear $studyFieldYear,
        StudyFieldYearService $studyFieldYearService,
        AssessmentService $assessmentService,
        RecommendationService $recommendationService,
    ): StudyFieldYear {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        if ($patchStudyFieldYearRequest->has('assessment_id')) {
            $assessment_id = $patchStudyFieldYearRequest->assessment_id;
            if (!$assessment_id) {
                $studyFieldYearService->attacheAssessment($studyFieldYear);
            } else {
                /* @var $assessment Assessment */
                $assessment = $assessmentService->getById($assessment_id);
                if (!$assessment) {
                    abort(404, 'assessment not found');
                }
                $studyFieldYearService->attacheAssessment($studyFieldYear, $assessment);
            }
        }

        if ($patchStudyFieldYearRequest->has('recommendation_id')) {
            $recommendation_id = $patchStudyFieldYearRequest->recommendation_id;
            if (!$recommendation_id) {
                $studyFieldYearService->setRecommendation($studyFieldYear);
            } else {
                /* @var $recommendation Recommendation */
                $recommendation = $recommendationService->getById($recommendation_id);
                if (!$recommendation) {
                    abort(404, 'assessment not found');
                }
                $studyFieldYearService->setRecommendation($studyFieldYear, $recommendation);
            }
        }

        return $studyFieldYear;
    }
}
