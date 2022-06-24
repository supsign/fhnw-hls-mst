<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Completion\AddToCourseGroupRequest;
use App\Models\Completion;
use App\Services\Completion\CompletionService;

class CompletionController extends Controller
{
    public function __construct(protected CompletionService $completionService)
    {
    }

    public function addToCourseGroup(Completion $completion, AddToCourseGroupRequest $request): Completion
    {
        return $this->completionService->addToCourseGroup($completion, $request);
    }
}
