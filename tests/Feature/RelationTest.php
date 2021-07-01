<?php

namespace Tests\Feature;

use App\Models\Assessment;
use App\Models\Completion;
use App\Models\Course;
use App\Models\CourseGroup;
use App\Models\CourseCourseGroup;
use App\Models\CrossQualification;
use App\Models\CourseCrossQualification;
use App\Models\Event;
use App\Models\Mentor;
use App\Models\Skill;
use App\Models\SkillStundent;
use App\Models\Student;
use App\Models\StudyField;
use App\Models\User;

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
        $course = Course::find(2);

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
        $this->assertTrue($course->courseGroupStartSemesters()->first()->year === 2021);
        $this->assertTrue($course->courseGroupStartSemesters()->first()->courseGroupCourses()->first()->id === $course->id);

        $crossQualification = CrossQualification::create();
        $ccq = CourseCrossQualification::create([
            'course_id' => $course->id,
            'cross_qualification_id' => $crossQualification->id,
            'start_semester_id' => 1,
        ]);

        $this->assertTrue($course->crossQualifications()->first()->id === $courseGroup->id);
        $this->assertTrue($course->crossQualifications()->first()->courses()->first()->id === $course->id);
        $this->assertTrue($course->crossQualificationStartSemesters()->first()->year === 2021);
        $this->assertTrue($course->crossQualificationStartSemesters()->first()->crossQualificationCourses()->first()->id === $course->id);
    }

    public function test_userRelations()
    {
        $mentor = Mentor::create(['evento_person_id' => 1]);
        $student = Student::create([
            'start_semester_id' => 1,
            'study_field_id' => 1,
            'evento_person_id' => 2
        ]);
        $user = User::create([
            'mentor_id' => $mentor->id,
            'student_id' => $student->id
        ]);

        $this->assertTrue($user->mentor->evento_person_id === 1);
        $this->assertTrue($user->student->evento_person_id === 2);
        $this->assertTrue($user->mentor->users()->first()->id === $user->id);
        $this->assertTrue($user->student->users()->first()->id === $user->id);
    }

    public function test_studyfieldRelations()
    {
        $studyField = StudyField::find(1);

        $this->assertTrue($studyField->studyProgram->name === 'Weitere Certificates of Advanced Studies');
        $this->assertTrue($studyField->studyProgram->studyFields()->first()->id === $studyField->id);
    }

    public function test_studentRelations()
    {
        $student = Student::create([
            'start_semester_id' => 1,
            'study_field_id' => 2,
            'evento_person_id' => 2
        ]);

        $this->assertTrue($student->startSemester->year === 2021);
        $this->assertTrue($student->startSemester->students()->first()->id === $student->id);

        $this->assertTrue($student->studyField->name === 'Medizintechnik');
        $this->assertTrue($student->studyField->students()->first()->id === $student->id);
    }

    public function test_skillStudentRelations()
    {
        $event = Event::create([
            'evento_anlass_id' => 1,
            'semester_id' => 1,
            'course_id' => 1,
        ]);
        $skill = Skill::find(4);
        $student = Student::create([
            'start_semester_id' => 1,
            'study_field_id' => 2,
            'evento_person_id' => 2,
        ]);
        $skillStudent = SkillStundent::create([
            'event_id' => $event->id,
            'skill_id' => $skill->id,
            'student_id' => $student->id,
        ]);

        $this->assertTrue($skill->students()->first()->id === $student->id);
        $this->assertTrue($student->skills()->first()->id === $skill->id);
        $this->assertTrue($skill->skillStudentEvents()->first()->id === $event->id);
        $this->assertTrue($student->skillStudentEvents()->first()->id === $event->id);
        $this->assertTrue($event->skillStudentSkills()->first()->id === $skill->id);
        $this->assertTrue($event->skillStudentStudents()->first()->id === $student->id);
    }
}

































