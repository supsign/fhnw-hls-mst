<?php

namespace Database\Seeders;

use App\Models\Semester;
use App\Services\Planning\CoursePlanningService;
use App\Services\Planning\PlanningService;
use App\Services\Student\StudentService;
use App\Services\StudyFieldYear\StudyFieldYearService;
use Illuminate\Database\Seeder;

class DemoStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(StudentService $studentService, PlanningService $planningService, StudyFieldYearService $studyFieldYearService, CoursePlanningService $coursePlanningService)
    {
        $student = $studentService->createOrUpdateOnEventoPersonId(5);
        $studyFieldYear = $studyFieldYearService->getByEventoId('1252215');
        $planning = $planningService->createEmptyPlanning($student, $studyFieldYear);
        $course = $studyFieldYear->courseGroupYears[0]->courses[0];
        $coursePlanningService->planCourse($planning, $course, Semester::first());
    }
}
