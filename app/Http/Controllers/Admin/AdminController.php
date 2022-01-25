<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCourseGroupYear;
use App\Services\Faq\FrequentlyAskedQuestionService;
use App\Services\User\PermissionAndRoleService;
use App\Services\User\UserService;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    public function __construct(protected PermissionAndRoleService $permissionAndRoleService, protected UserService $userService)
    {
    }

    public function courses(): View
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        $courses = CourseCourseGroupYear::all()->pluck('course')->unique();
        return view('admin.courses', [
            'courses' => $courses,
        ]);
    }

    public function dashboard(): View
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return view('admin.dashboard');
    }

    public function faq(FrequentlyAskedQuestionService $faqService): View
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return view('admin.faq', ['faqs' => $faqService->getAllWithTrashed()]);
    }
}
