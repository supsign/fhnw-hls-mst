<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Models\StudyField;
use App\Services\User\PermissionAndRoleService;
use Illuminate\Contracts\View\View;

class AdminMentorController extends Controller
{

    public function __construct(protected PermissionAndRoleService $permissionAndRoleService)
    {
    }

    public function mentors(): View
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        $mentors = Mentor::orderBy('lastname')->get();
        return view('admin.mentors', ['mentors' => $mentors]);
    }

    public function showOne(Mentor $mentor): View
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        $studyFields = StudyField::all();
        return view('admin.mentor', [
            'mentor' => $mentor,
            'studyFields' => $studyFields
        ]);
    }
}
