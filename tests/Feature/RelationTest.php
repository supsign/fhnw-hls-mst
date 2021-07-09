<?php

namespace Tests\Feature;

use App\Models\Assessment;
use App\Models\Completion;
use App\Models\Course;
use App\Models\CourseGroup;
use App\Models\CourseCourseGroup;
use App\Models\CrossQualification;
use App\Models\CourseCrossQualification;
use App\Models\CoursePlanning;
use App\Models\CourseRecommendation;
use App\Models\CourseSpecialization;
use App\Models\Event;
use App\Models\Mentor;
use App\Models\Planning;
use App\Models\Recommendation;
use App\Models\Specialization;
use App\Models\Skill;
use App\Models\SkillStundent;
use App\Models\Student;
use App\Models\StudyField;
use App\Models\User;

use Carbon\Carbon;
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
            'study_field_id' => 13,
            'start_semester_id' => 1
        ]);

        $this->assertTrue($assessment->course->number === 'B-LS-BZ 005');
        $this->assertTrue($assessment->studyField->name === 'Chemie');
        $this->assertTrue($assessment->startSemester->year === 2021);
        $this->assertTrue($assessment->course->assessments()->first()->id === $assessment->id);
        $this->assertTrue($assessment->studyField->assessments()->first()->id === $assessment->id);
        $this->assertTrue($assessment->startSemester->assessments()->first()->id === $assessment->id);
        
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
            'study_field_id' => 7,
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
        $course = Course::find(2);

        $this->assertTrue($course->courseType->courses()->first()->id === $course->id);
        $this->assertTrue($course->langauge->courses()->where('id', 2)->first()->id === $course->id);
        $this->assertTrue($course->courseGroups()->count() === 5);
        $this->assertTrue($course->courseGroupStartSemesters()->first()->year === 2021);

        $crossQualification = CrossQualification::create();
        $ccq = CourseCrossQualification::create([
            'course_id' => $course->id,
            'cross_qualification_id' => $crossQualification->id,
            'start_semester_id' => 1,
        ]);

        $this->assertTrue($course->crossQualifications()->first()->id === $crossQualification->id);
        $this->assertTrue($course->crossQualifications()->first()->courses()->first()->id === $course->id);
        $this->assertTrue($course->crossQualificationStartSemesters()->first()->year === 2021);
        $this->assertTrue($course->crossQualificationStartSemesters()->first()->crossQualificationCourses()->first()->id === $course->id);
        $this->assertTrue($course->crossQualificationStartSemesters()->first()->crossQualificationCrossQualifications()->first()->id === $crossQualification->id);
        $this->assertTrue($course->crossQualificationStartSemesters()->first()->id === $crossQualification->startSemesters()->first()->id);
    }

    public function test_userRelations()
    {
        $student = Student::create([
            'start_semester_id' => 1,
            'study_field_id' => 7,
            'evento_person_id' => 2
        ]);
        $user = User::create([
            'mentor_id' => Mentor::create(['evento_person_id' => 1])->id,
            'student_id' => $student->id
        ]);

        $this->assertTrue($user->mentor->evento_person_id === 1);
        $this->assertTrue($user->student->evento_person_id === 2);
        $this->assertTrue($user->mentor->users()->first()->id === $user->id);
        $this->assertTrue($user->student->users()->first()->id === $user->id);
    }

    public function test_studyfieldRelations()
    {
        $studyField = StudyField::find(34);

        $this->assertTrue($studyField->studyProgram->name === 'Weitere Certificates of Advanced Studies');
        $this->assertTrue($studyField->studyProgram->studyFields()->first()->id === $studyField->id);
    }

    public function test_studentRelations()
    {
        $student = Student::create([
            'start_semester_id' => 1,
            'study_field_id' => 12,
            'evento_person_id' => 2
        ]);

        $this->assertTrue($student->startSemester->year === 2021);
        $this->assertTrue($student->startSemester->students()->first()->id === $student->id);
        $this->assertTrue($student->studyField->name === 'Medizintechnik');
        $this->assertTrue($student->studyField->students()->first()->id === $student->id);
    }

    public function test_skillstudentRelations()
    {
        $event = Event::create([
            'evento_anlass_id' => 1,
            'semester_id' => 1,
            'course_id' => 1,
        ]);
        $skill = Skill::find(4);
        $student = Student::create([
            'start_semester_id' => 1,
            'study_field_id' => 8,
            'evento_person_id' => 2,
        ]);
        $skillStudent = SkillStundent::create([
            'event_id' => $event->id,
            'skill_id' => $skill->id,
            'student_id' => $student->id,
        ]);

        $this->assertTrue($skill->taxonomy->name === 'anwenden');
        $this->assertTrue($skill->students()->first()->id === $student->id);
        $this->assertTrue($student->skills()->first()->id === $skill->id);
        $this->assertTrue($skill->skillStudentEvents()->first()->id === $event->id);
        $this->assertTrue($student->skillStudentEvents()->first()->id === $event->id);
        $this->assertTrue($event->skillStudentSkills()->first()->id === $skill->id);
        $this->assertTrue($event->skillStudentStudents()->first()->id === $student->id);
    }

    public function test_recommendationRelations()
    {
        $recommendation = Recommendation::create([
            'cross_qualification_id' => CrossQualification::create()->id,
            'specialization_id' => Specialization::create()->id,
            'start_semester_id' => 1,
            'study_field_id' => 8,
        ]);

        $this->assertTrue($recommendation->crossQualification->recommendations()->first()->id === $recommendation->id);
        $this->assertTrue($recommendation->specialization->recommendations()->first()->id === $recommendation->id);
        $this->assertTrue($recommendation->startSemester->recommendations()->first()->id === $recommendation->id);
        $this->assertTrue($recommendation->studyField->recommendations()->first()->id === $recommendation->id);
    }

    public function test_planningRelations()
    {
        $student = Student::create([
            'start_semester_id' => 1,
            'study_field_id' => 7,
            'evento_person_id' => 2
        ]);
        $planning = Planning::create([
            'cross_qualification_id' => CrossQualification::create()->id,
            'mentor_id' => Mentor::create(['evento_person_id' => 3])->id,
            'specialization_id' => Specialization::create()->id,
            'student_id' => $student->id,
        ]);

        $this->assertTrue($planning->crossQualification->plannings()->first()->id === $planning->id);
        $this->assertTrue($planning->mentor->plannings()->first()->id === $planning->id);
        $this->assertTrue($planning->specialization->plannings()->first()->id === $planning->id);
        $this->assertTrue($planning->student->plannings()->first()->id === $planning->id);
    }

    public function test_mentorStudentRelations()
    {
        $student = Student::create([
            'start_semester_id' => 1,
            'study_field_id' => 7,
            'evento_person_id' => 4
        ]);

        $mentor = $student->mentors()->create(['evento_person_id' => 5]);

        $this->assertTrue($mentor->students()->first()->id === $student->id);
    }

    public function test_eventLessonRelations()
    {
        $event = Event::create([
            'course_id' => 1,
            'semester_id' => 1,
            'evento_anlass_id' => 1
        ]);
        $lesson = $event->lessons()->create([
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),
        ]);

        $this->assertTrue($lesson->event->id === $event->id);
        $this->assertTrue($event->semester->year === 2021);
        $this->assertTrue($event->course->number === 'B-LS-BZ 005');
    }

    public function test_courseSpecializationRelations()
    {
        $course = Course::find(1);
        $specialization = $course->specializations()->first();

        $this->assertTrue($specialization->name === 'UT - Naturwissenschaft');
        $this->assertTrue($specialization->courses()->first()->id === $course->id);
        $this->assertTrue($course->courseSpecializationStartSemesters()->first()->year === 2021);
        $this->assertTrue($specialization->startSemesters()->first()->year === 2021);
        $this->assertTrue($specialization->startSemesters()->first()->courseSpecializationCourses()->first()->id === $course->id);
    }

    public function test_courseRecommendationRelations()
    {
        $course = Course::find(1);
        $recommendation = Recommendation::create([
            'cross_qualification_id' => CrossQualification::create()->id,
            'specialization_id' => Specialization::create()->id,
            'start_semester_id' => 1,
            'study_field_id' => 7,
        ]);
        $courseRecommendation = CourseRecommendation::create([
            'course_id' => $course->id,
            'semester_id' => 1,
            'recommendation_id' => $recommendation->id,
        ]);

        $this->assertTrue($course->recommendations()->first()->id === $recommendation->id);
        $this->assertTrue($recommendation->courses()->first()->id === $course->id);
        $this->assertTrue($course->courseRecommendationSemesters()->first()->year === 2021);
        $this->assertTrue($recommendation->semesters()->first()->year === 2021);
        $this->assertTrue($course->courseRecommendationSemesters()->first()->courseRecommendationRecommendations()->first()->id === $recommendation->id);
        $this->assertTrue($recommendation->semesters()->first()->courseRecommendationCourses()->first()->id === $course->id);
    }

    public function test_coursePlanningRelations()
    {
        $course = Course::find(1);
        $student = Student::create([
            'start_semester_id' => 1,
            'study_field_id' => 7,
            'evento_person_id' => 2
        ]);
        $planning = Planning::create([
            'cross_qualification_id' => CrossQualification::create()->id,
            'mentor_id' => Mentor::create(['evento_person_id' => 3])->id,
            'specialization_id' => Specialization::create()->id,
            'student_id' => $student->id,
        ]);
        $coursePlanning = CoursePlanning::create([
            'course_id' => $course->id,
            'semester_id' => 1,
            'planning_id' => $planning->id,
        ]);

        $this->assertTrue($course->plannings()->first()->id === $planning->id);
        $this->assertTrue($planning->courses()->first()->id === $course->id);
        $this->assertTrue($course->coursePlanningSemesters()->first()->year === 2021);
        $this->assertTrue($planning->semesters()->first()->year === 2021);
        $this->assertTrue($course->coursePlanningSemesters()->first()->coursePlanningPlannings()->first()->id === $planning->id);
        $this->assertTrue($planning->semesters()->first()->coursePlanningCourses()->first()->id === $course->id);
    }
}

































