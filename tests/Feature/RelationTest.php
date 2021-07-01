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
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $assessment = Assessment::create();

        $assessment->course()->create(['number' => 7]);
        $assessment->studyField()->create();
        $assessment->startSemester()->create();
    }
}
