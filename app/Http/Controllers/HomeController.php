<?php

namespace App\Http\Controllers;

use App\Models\CrossQualification;
use App\Models\CrossQualificationYear;
use App\Models\StudyField;
use App\Models\StudyFieldYear;
use App\Services\Faq\FrequentlyAskedQuestionService;
use App\Services\User\PermissionAndRoleService;

class HomeController extends Controller
{
    public function __construct(protected PermissionAndRoleService $permissionAndRoleService)
    {}

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
