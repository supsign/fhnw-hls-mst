<?php

namespace Tests\Feature;


use App\Models\Assessment;
use App\Models\Course;
use App\Models\Semester;
use App\Models\StudyField;

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
}
