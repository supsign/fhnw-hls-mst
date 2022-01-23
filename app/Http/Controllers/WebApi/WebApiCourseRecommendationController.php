<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRecommendation\PostCourseRecommendationRequest;
use App\Models\Course;
use App\Models\CourseRecommendation;
use App\Models\Recommendation;
use App\Services\Course\CourseService;
use App\Services\CourseRecommendation\CourseRecommendationService;
use App\Services\Recommendation\RecommendationService;
use App\Services\User\PermissionAndRoleService;

class WebApiCourseRecommendationController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
    )
    {
    }

    public function post(
        PostCourseRecommendationRequest $postCourseRecommendationRequest,
        CourseService                   $courseService,
        RecommendationService           $recommendationService,
        CourseRecommendationService     $courseRecommendationService
    ): CourseRecommendation
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        /* @var $course Course */
        $course = $courseService->getById($postCourseRecommendationRequest->input('course_id'));

        /* @var $recommendation Recommendation */
        $recommendation = $recommendationService->getById(
            $postCourseRecommendationRequest->get('recommendation_id')
        );

        if (!$course || !$recommendation) {
            abort(404);
        }

        return $courseRecommendationService->attach($recommendation, $course, $postCourseRecommendationRequest->planned_semester);
    }

    public function delete(CourseRecommendation $courseRecommendation, CourseRecommendationService $courseRecommendationService): void
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        $courseRecommendationService->remove($courseRecommendation);
    }
}
