<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faq\PatchFrequentlyAskedQuestionRequest;
use App\Http\Requests\Faq\PostFrequentlyAskedQuestionRequest;
use App\Models\FrequentlyAskedQuestion;
use App\Services\Faq\FrequentlyAskedQuestionService;
use App\Services\User\PermissionAndRoleService;

class FrequentlyAskedQuestionController extends Controller
{
    public function __construct(
        protected FrequentlyAskedQuestionService $faqService,
        protected PermissionAndRoleService $permissionAndRoleService,
    ) {
    }

    public function create(
        PostFrequentlyAskedQuestionRequest $request,

    ) {
        return $this->faqService->createFromPostRequest($request);
    }

    public function delete(FrequentlyAskedQuestion $faq)
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return $faq->delete();
    }

    public function patch(
        FrequentlyAskedQuestion $faq,
        PatchFrequentlyAskedQuestionRequest $request,
    ) {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return $this->faqService->updateFromPatchRequest($faq, $request);
    }

    public function sortDown(FrequentlyAskedQuestion $faq)
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        $this->faqService->sortOrderDown($faq);

        return response();
    }

    public function sortUp(FrequentlyAskedQuestion $faq)
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        $this->faqService->sortOrderUp($faq);

        return response();
    }
}
