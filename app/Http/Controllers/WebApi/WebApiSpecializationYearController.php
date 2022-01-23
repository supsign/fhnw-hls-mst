<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpecializationYear\PatchSpecializationYearRequest;
use App\Models\Assessment;
use App\Models\Recommendation;
use App\Models\SpecializationYear;
use App\Services\Assessment\AssessmentService;
use App\Services\Recommendation\RecommendationService;
use App\Services\SpecializationYear\SpecializationYearService;
use App\Services\User\PermissionAndRoleService;

class WebApiSpecializationYearController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
    )
    {
    }

    public function get(SpecializationYear $specializationYear): SpecializationYear
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        return $specializationYear;
    }

    public function patch(
        PatchSpecializationYearRequest $patchSpecializationYearRequest,
        SpecializationYear             $specializationYear,
        SpecializationYearService      $specializationYearService,
        AssessmentService              $assessmentService,
        RecommendationService          $recommendationService,
    ): SpecializationYear
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        $specializationYearService->setAmountToPass($specializationYear, $patchSpecializationYearRequest->amount_to_pass);

        if ($patchSpecializationYearRequest->has('assessment_id')) {
            $assessment_id = $patchSpecializationYearRequest->assessment_id;
            if (!$assessment_id) {
                $specializationYearService->setAssessment($specializationYear);
            } else {
                /* @var $assessment Assessment */
                $assessment = $assessmentService->getById($assessment_id);
                if (!$assessment) {
                    abort(404, 'assessment not found');
                }
                $specializationYearService->setAssessment($specializationYear, $assessment);
            }
        }

        if ($patchSpecializationYearRequest->has('recommendation_id')) {
            $recommendation_id = $patchSpecializationYearRequest->recommendation_id;
            if (!$recommendation_id) {
                $specializationYearService->setRecommendation($specializationYear);
            } else {
                /* @var $recommendation Recommendation */
                $recommendation = $recommendationService->getById($recommendation_id);
                if (!$recommendation) {
                    abort(404, 'assessment not found');
                }
                $specializationYearService->setRecommendation($specializationYear, $recommendation);
            }
        }

        return $specializationYear;
    }

}
