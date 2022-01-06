<?php

namespace App\Http\Controllers;

use App\Services\Faq\FrequentlyAskedQuestionsService;
use App\Services\User\PermissionAndRoleService;

class HomeController extends Controller
{
    public function __construct(protected PermissionAndRoleService $permissionAndRoleService)
    {
    }

    public function index()
    {
        $this->permissionAndRoleService->canShowAppOrAbort();

        return view('pages.home');
    }

    public function faq(FrequentlyAskedQuestionsService $faqService)
    {
        $this->permissionAndRoleService->canShowAppOrAbort();

        return view('pages.faq', ['faqs' => $faqService->getAll()]);
    }
}
