<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoursePlanning\PostRequest;
use App\Models\CoursePlanning;
use App\Services\Planning\CoursePlanningService;
use App\Services\User\PermissionAndRoleService;

class CoursePlanningController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
        protected CoursePlanningService $coursePlanningService,
    ) {
    }

    public function delete(CoursePlanning $coursePlanning)
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        $this->coursePlanningService->delete($coursePlanning);
    }

    public function post(PostRequest $request)
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        $this->coursePlanningService->updateOrCreate(
            $request->course_id,
            $request->planning_id,
            $request->semester_id,
        );
    }

}
