<?php

namespace Tests\Feature;

use App\Models\Assessment;
use App\Models\Course;
use App\Models\CourseGroup;
use App\Models\CourseGroupYear;
use App\Models\CoursePlanning;
use App\Models\CrossQualification;
use App\Models\CrossQualificationYear;
use App\Models\Planning;
use App\Models\Recommendation;
use App\Models\Semester;
use App\Models\Specialization;
use App\Models\SpecializationYear;
use App\Models\Student;
use App\Models\StudyField;
use App\Models\StudyFieldYear;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class RelationTest extends TestCase
{
    use RefreshDatabase;

    public function testCourses()
    {
        $course = Course::inRandomOrder()->first();

        //  belongsTo
        $this->assertTrue($course->courseType->courses()->where('id', $course->id)->first()->id === $course->id);
        $this->assertTrue($course->language->courses()->where('id', $course->id)->first()->id === $course->id);

        $course->studyField()->associate(StudyField::inRandomOrder()->first());
        $course->save();

        $this->assertTrue($course->studyField->courses()->where('id', $course->id)->first()->id === $course->id);

        $course->crossQualificationYears()->attach(
            $cqyID = CrossQualificationYear::create([
                'cross_qualification_id' => CrossQualification::inRandomOrder()->first()->id,
                'study_field_year_id' => StudyFieldYear::inRandomOrder()->first()->id,
            ])->id
        );

        $this->assertTrue($course->crossQualificationYears()->where('course_id', $course->id)->first()->courses()->where('cross_qualification_year_id', $cqyID)->first()->id === $course->id);

        $course->specializationYears()->attach(
            $spID = SpecializationYear::create([
                'specialization_id' => Specialization::inRandomOrder()->first()->id,
                'study_field_year_id' => $sfyID = StudyFieldYear::create([
                    'begin_semester_id' => Semester::inRandomOrder()->first()->id,
                    'study_field_id' => StudyField::inRandomOrder()->first()->id,
                ])->id,
            ])->id
        );
        $this->assertTrue($course->specializationYears()->where('course_id', $course->id)->first()->courses()->where('specialization_year_id', $spID)->first()->id === $course->id);

        $course->assessments()->attach(
            $aID = Assessment::create([
                'cross_qualification_year_id' => $cqyID,
                'specialization_year_id' => $spID,
                'study_field_year_id' => $sfyID,
            ])->id
        );
        $this->assertTrue($course->assessments()->where('course_id', $course->id)->first()->courses()->where('assessment_id', $aID)->first()->id === $course->id);

        $course->recommendations()->attach(
            $rID = Recommendation::create([
                'cross_qualification_year_id' => $cqyID,
                'specialization_year_id' => $spID,
                'study_field_year_id' => $sfyID,
            ])->id
        );
        $this->assertTrue($course->recommendations()->where('course_id', $course->id)->first()->courses()->where('recommendation_id', $rID)->first()->id === $course->id);

        CoursePlanning::create([
            'course_id' => $course->id,
            'semester_id' => Semester::inRandomOrder()->first()->id,
            'planning_id' => $pID = Planning::create([
                'study_field_year_id' => $sfyID,
                'student_id' => Student::create([
                    'study_field_year_id' => $sfyID,
                    'evento_person_id_hash' => 1234,
                ])->id,
            ])->id,
        ]);
        $this->assertTrue($course->plannings()->where('course_id', $course->id)->first()->courses()->where('planning_id', $pID)->first()->id === $course->id);

        // TODO courseSkill
    }

    public function testNew()
    {
        $this->assertTrue(true);
    }
}
