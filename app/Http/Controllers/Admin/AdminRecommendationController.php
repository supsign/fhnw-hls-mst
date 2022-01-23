<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recommendation;
use App\Services\User\PermissionAndRoleService;
use Illuminate\Contracts\View\View;

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
}
