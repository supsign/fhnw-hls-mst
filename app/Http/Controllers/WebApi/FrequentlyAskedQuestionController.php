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
    public function __construct(protected PermissionAndRoleService $permissionAndRoleService)
    {
    }

    public function create(
        PostFrequentlyAskedQuestionRequest $request,
        FrequentlyAskedQuestionService $faqService,
    ) {
        return $faqService->createFromPostRequest($request);
    }

    public function delete(FrequentlyAskedQuestion $faq)
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return $faq->delete();
    }

    public function patch(
        FrequentlyAskedQuestion $faq,
        PatchFrequentlyAskedQuestionRequest $request,
        FrequentlyAskedQuestionService $faqService,
    ) {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return $faqService->updateFromPatchRequest($faq, $request);
    }
}
