<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recommendation\PatchRecommendationRequest;
use App\Models\Recommendation;
use App\Services\Recommendation\RecommendationService;
use App\Services\User\PermissionAndRoleService;

class WebApiRecommendationController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
    )
    {
    }

    public function get(Recommendation $recommendation): Recommendation
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return $recommendation;
    }

    public function patch(
        PatchRecommendationRequest $patchRecommendationRequest,
        Recommendation             $recommendation,
        RecommendationService      $recommendationService,
    ): Recommendation
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        if ($patchRecommendationRequest->has('name')) {
            $recommendationService->setName($recommendation, $patchRecommendationRequest->name);
        }

        return $recommendation;
    }
}
