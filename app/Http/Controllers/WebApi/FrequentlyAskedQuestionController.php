<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faq\PatchFrequentlyAskedQuestionRequest;
use App\Models\FrequentlyAskedQuestion;
use App\Services\Faq\FrequentlyAskedQuestionService;
use App\Services\User\PermissionAndRoleService;

class FrequentlyAskedQuestionsController extends Controller
{
    public function __construct(protected PermissionAndRoleService $permissionAndRoleService)
    {
    }

    public function patch(
        FrequentlyAskedQuestion $faq,
        PatchFrequentlyAskedQuestionRequest $request,
        FrequentlyAskedQuestionService $faqService
    ) {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        $faqService->updateFromPatchRequest($faq, $request);

        return $faq;
    }
}
