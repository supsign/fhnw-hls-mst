<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CrossQualificationYear\PatchCrossQualificationYearRequest;
use App\Models\Assessment;
use App\Models\CrossQualificationYear;
use App\Models\Recommendation;
use App\Services\Assessment\AssessmentService;
use App\Services\CrossQualificationYear\CrossQualificationYearService;
use App\Services\Recommendation\RecommendationService;
use App\Services\User\PermissionAndRoleService;

class WebApiCrossQualificationYearController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
    )
    {
    }

    public function get(CrossQualificationYear $crossQualificationYear): CrossQualificationYear
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        return $crossQualificationYear;
    }

    public function patch(
        PatchCrossQualificationYearRequest $patchCrossQualificationYearRequest,
        CrossQualificationYear             $crossQualificationYear,
        CrossQualificationYearService      $crossQualificationYearService,
        AssessmentService                  $assessmentService,
        RecommendationService              $recommendationService
    ): CrossQualificationYear
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        $crossQualificationYearService
            ->patchAmountToPass(
                $crossQualificationYear,
                $patchCrossQualificationYearRequest->amount_to_pass
            );

        if ($patchCrossQualificationYearRequest->has('assessment_id')) {
            $assessment_id = $patchCrossQualificationYearRequest->assessment_id;
            if (!$assessment_id) {
                $crossQualificationYearService->setAssessment($crossQualificationYear);
            } else {
                /* @var $assessment Assessment */
                $assessment = $assessmentService->getById($assessment_id);
                if (!$assessment) {
                    abort(404, 'assessment not found');
                }
                $crossQualificationYearService->setAssessment($crossQualificationYear, $assessment);
            }
        }

        if ($patchCrossQualificationYearRequest->has('recommendation_id')) {
            $recommendation_id = $patchCrossQualificationYearRequest->recommendation_id;
            if (!$recommendation_id) {
                $crossQualificationYearService->setRecommendation($crossQualificationYear);
            } else {
                /* @var $recommendation Recommendation */
                $recommendation = $recommendationService->getById($recommendation_id);
                if (!$recommendation) {
                    abort(404, 'assessment not found');
                }
                $crossQualificationYearService->setRecommendation($crossQualificationYear, $recommendation);
            }
        }

        return $crossQualificationYear;
    }
}
