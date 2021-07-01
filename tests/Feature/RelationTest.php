<?php

namespace Tests\Feature;


use App\Models\Assessment;
use App\Models\Completion;
use App\Models\Course;
use App\Models\CourseGroup;
use App\Models\CourseCourseGroup;
use App\Models\Event;
use App\Models\Student;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RelationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_assessmentRelations()
    {
        $assessment = Assessment::create([
            'course_id' => 1,
            'study_field_id' => 1,
            'start_semester_id' => 1
        ]);

        $this->assertTrue($assessment->course->number === 'A1');
        $this->assertTrue($assessment->studyField->name === 'Chemie');
        $this->assertTrue($assessment->startSemester->year === 2021);
        $this->assertTrue($assessment->course->assessments()->first()->id === $assessment->id);
        $this->assertTrue($assessment->studyField()->first()->id === $assessment->id);
        $this->assertTrue($assessment->startSemester()->first()->id === $assessment->id);
    }

    public function test_completionRelations()
    {
        $event = Event::create([
            'evento_anlass_id' => 1,
            'semester_id' => 1,
            'course_id' => 1,
        ]);

        $student = Student::create([
            'evento_person_id' => 1,
            'start_semester_id' => 1,
            'study_field_id' => 1,
        ]);

        $completion = Completion::create([
            'event_id' => $event->id,
            'student_id' => $student->id,
        ]);

        $this->assertTrue($completion->student->completions()->first()->id === $completion->id);
        $this->assertTrue($completion->event->completions()->first()->id === $completion->id);
    }

    public function test_courseRelations()
    {
        $course = Course::find(1);

        $this->assertTrue($course->courseType->courses()->first()->id === $course->id);
        $this->assertTrue($course->langauge->courses()->first()->id === $course->id);

        $courseGroup = CourseGroup::create();
        $ccg = CourseCourseGroup::create([
            'course_id' => $course->id,
            'course_group_id' => $courseGroup->id,
            'start_semester_id' => 1,
        ]);

        $this->assertTrue($course->courseGroups()->first()->id === $courseGroup->id);
        $this->assertTrue($course->courseGroups()->first()->courses()->first()->id === $course->id);
        $this->assertTrue($course->startSemesters()->first()->year === 2021);
        $this->assertTrue($course->startSemesters()->first()->courses()->first()->id === $course->id);
    }
}