<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recommendation;
use App\Services\Recommendation\CopyRecommendationService;
use App\Services\Recommendation\SetHsFsBasedOnRecommendationService;
use App\Services\User\PermissionAndRoleService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AdminRecommendationController extends Controller
{
    public function __construct(protected PermissionAndRoleService $permissionAndRoleService)
    {
    }

    public function showOne(Recommendation $recommendation): View
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return view('admin.recommendation', ['recommendation' => $recommendation]);
    }

    public function copy(Recommendation $recommendation, CopyRecommendationService $copyRecommendationService): Application|RedirectResponse|Redirector
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        $newRecommendation = $copyRecommendationService->execute($recommendation);

        return redirect(route('admin.recommendation.showOne', [$newRecommendation]));
    }

    public function setFsHs(Recommendation $recommendation, SetHsFsBasedOnRecommendationService $setHsFsBasedOnRecommendationService): Application|RedirectResponse|Redirector
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        $setHsFsBasedOnRecommendationService->execute($recommendation);

        return redirect(route('admin.recommendation.showOne', [$recommendation]));
    }
}
