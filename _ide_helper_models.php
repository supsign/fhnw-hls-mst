<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Assessment
 *
 * @mixin IdeHelperAssessment
 * @property int $id
 * @property string|null $name
 * @property int|null $amount_to_pass
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BaseCollection|\App\Models\Course[] $courses
 * @property-read int|null $courses_count
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereAmountToPass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereUpdatedAt($value)
 */
	class IdeHelperAssessment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AssessmentCourse
 *
 * @mixin IdeHelperAssessmentCourse
 * @property int $id
 * @property int $course_id
 * @property int $assessment_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Assessment $assessment
 * @property-read \App\Models\Course $course
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|AssessmentCourse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssessmentCourse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssessmentCourse query()
 * @method static \Illuminate\Database\Eloquent\Builder|AssessmentCourse whereAssessmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssessmentCourse whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssessmentCourse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssessmentCourse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssessmentCourse whereUpdatedAt($value)
 */
	class IdeHelperAssessmentCourse extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BaseModel
 *
 * @mixin IdeHelperBaseModel
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel query()
 */
	class IdeHelperBaseModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Completion
 *
 * @mixin IdeHelperCompletion
 * @property int $id
 * @property int $course_year_id
 * @property int $student_id
 * @property int|null $evento_id
 * @property int $credits
 * @property int $completion_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CompletionType $completionType
 * @property-read \App\Models\CourseYear $courseYear
 * @property-read mixed $course_id
 * @property-read \App\Models\Student $student
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Completion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Completion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Completion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Completion whereCompletionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Completion whereCourseYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Completion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Completion whereCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Completion whereEventoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Completion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Completion whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Completion whereUpdatedAt($value)
 */
	class IdeHelperCompletion extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CompletionType
 *
 * @mixin IdeHelperCompletionType
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BaseCollection|\App\Models\Completion[] $completions
 * @property-read int|null $completions_count
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|CompletionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompletionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompletionType query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompletionType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompletionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompletionType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompletionType whereUpdatedAt($value)
 */
	class IdeHelperCompletionType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Course
 *
 * @mixin IdeHelperCourse
 * @property int $id
 * @property int $course_type_id
 * @property int $language_id
 * @property int|null $study_field_id
 * @property int|null $evento_id
 * @property string $number
 * @property string|null $number_unformated
 * @property string|null $name
 * @property int $credits
 * @property bool $is_fs
 * @property bool $is_hs
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BaseCollection|\App\Models\Assessment[] $assessments
 * @property-read int|null $assessments_count
 * @property-read \App\Models\BaseCollection|\App\Models\CourseCourseGroupYear[] $courseCourseGroupYears
 * @property-read int|null $course_course_group_years_count
 * @property-read \App\Models\BaseCollection|\App\Models\CourseCrossQualificationYear[] $courseCrossQualificationsYears
 * @property-read int|null $course_cross_qualifications_years_count
 * @property-read \App\Models\BaseCollection|\App\Models\CourseGroupYear[] $courseGroupYears
 * @property-read int|null $course_group_years_count
 * @property-read \App\Models\BaseCollection|\App\Models\CourseSkill[] $courseSkills
 * @property-read int|null $course_skills_count
 * @property-read \App\Models\CourseType $courseType
 * @property-read \App\Models\BaseCollection|\App\Models\CourseYear[] $courseYears
 * @property-read int|null $course_years_count
 * @property-read \App\Models\BaseCollection|\App\Models\CrossQualificationYear[] $crossQualificationYears
 * @property-read int|null $cross_qualification_years_count
 * @property-read \App\Models\Language $language
 * @property-read \App\Models\BaseCollection|\App\Models\Planning[] $plannings
 * @property-read int|null $plannings_count
 * @property-read \App\Models\BaseCollection|\App\Models\Recommendation[] $recommendations
 * @property-read int|null $recommendations_count
 * @property-read \App\Models\BaseCollection|\App\Models\Skill[] $skills
 * @property-read int|null $skills_count
 * @property-read \App\Models\BaseCollection|\App\Models\SpecializationYear[] $specializationYears
 * @property-read int|null $specialization_years_count
 * @property-read \App\Models\StudyField|null $studyField
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCourseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereEventoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereIsFs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereIsHs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereNumberUnformated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereStudyFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereUpdatedAt($value)
 */
	class IdeHelperCourse extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CourseCourseGroupYear
 *
 * @mixin IdeHelperCourseCourseGroupYear
 * @property int $id
 * @property int $course_group_year_id
 * @property int $course_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\CourseGroupYear $courseGroupYear
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCourseGroupYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCourseGroupYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCourseGroupYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCourseGroupYear whereCourseGroupYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCourseGroupYear whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCourseGroupYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCourseGroupYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCourseGroupYear whereUpdatedAt($value)
 */
	class IdeHelperCourseCourseGroupYear extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CourseCrossQualificationYear
 *
 * @mixin IdeHelperCourseCrossQualificationYear
 * @property int $id
 * @property int $course_id
 * @property int $cross_qualification_year_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\CrossQualification $crossQualification
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCrossQualificationYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCrossQualificationYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCrossQualificationYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCrossQualificationYear whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCrossQualificationYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCrossQualificationYear whereCrossQualificationYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCrossQualificationYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseCrossQualificationYear whereUpdatedAt($value)
 */
	class IdeHelperCourseCrossQualificationYear extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CourseGroup
 *
 * @mixin IdeHelperCourseGroup
 * @property int $id
 * @property string|null $import_id
 * @property int|null $study_field_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BaseCollection|\App\Models\CourseGroupYear[] $courseGroupYears
 * @property-read int|null $course_group_years_count
 * @property-read \App\Models\BaseCollection|\App\Models\Course[] $courses
 * @property-read int|null $courses_count
 * @property-read \App\Models\StudyField|null $studyField
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroup whereImportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroup whereStudyFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroup whereUpdatedAt($value)
 */
	class IdeHelperCourseGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CourseGroupYear
 *
 * @mixin IdeHelperCourseGroupYear
 * @property int $id
 * @property int $course_group_id
 * @property int $study_field_year_id
 * @property int|null $amount_to_pass
 * @property int|null $credits_to_pass
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BaseCollection|\App\Models\CourseCourseGroupYear[] $courseCourseGroupYears
 * @property-read int|null $course_course_group_years_count
 * @property-read \App\Models\CourseGroup $courseGroup
 * @property-read \App\Models\BaseCollection|\App\Models\Course[] $courses
 * @property-read int|null $courses_count
 * @property-read \App\Models\StudyFieldYear $studyFieldYear
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroupYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroupYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroupYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroupYear whereAmountToPass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroupYear whereCourseGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroupYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroupYear whereCreditsToPass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroupYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroupYear whereStudyFieldYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGroupYear whereUpdatedAt($value)
 */
	class IdeHelperCourseGroupYear extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CoursePlanning
 *
 * @mixin IdeHelperCoursePlanning
 * @property int $id
 * @property int $course_id
 * @property int $planning_id
 * @property int $semester_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\Planning $planning
 * @property-read \App\Models\Semester $semester
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePlanning newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePlanning newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePlanning query()
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePlanning whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePlanning whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePlanning whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePlanning wherePlanningId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePlanning whereSemesterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePlanning whereUpdatedAt($value)
 */
	class IdeHelperCoursePlanning extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CourseRecommendation
 *
 * @mixin IdeHelperCourseRecommendation
 * @property int $id
 * @property int $course_id
 * @property int $recommendation_id
 * @property int $planned_semester
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\Recommendation $recommendation
 * @property-read \App\Models\Semester $semester
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|CourseRecommendation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseRecommendation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseRecommendation query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseRecommendation whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseRecommendation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseRecommendation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseRecommendation wherePlannedSemester($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseRecommendation whereRecommendationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseRecommendation whereUpdatedAt($value)
 */
	class IdeHelperCourseRecommendation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CourseSkill
 *
 * @mixin IdeHelperCourseSkill
 * @property int $id
 * @property int $skill_id
 * @property int $course_id
 * @property int $from_semester_id
 * @property int|null $to_semester_id
 * @property int|null $goal_number
 * @property bool $is_acquisition
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\Semester $semester
 * @property-read \App\Models\Skill $skill
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSkill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSkill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSkill query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSkill whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSkill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSkill whereFromSemesterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSkill whereGoalNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSkill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSkill whereIsAcquisition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSkill whereSkillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSkill whereToSemesterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSkill whereUpdatedAt($value)
 */
	class IdeHelperCourseSkill extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CourseSpecializationYear
 *
 * @mixin IdeHelperCourseSpecializationYear
 * @property int $id
 * @property int $course_id
 * @property int $specialization_year_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\SpecializationYear $specializationYear
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSpecializationYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSpecializationYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSpecializationYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSpecializationYear whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSpecializationYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSpecializationYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSpecializationYear whereSpecializationYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSpecializationYear whereUpdatedAt($value)
 */
	class IdeHelperCourseSpecializationYear extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CourseType
 *
 * @mixin IdeHelperCourseType
 * @property int $id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BaseCollection|\App\Models\Course[] $courses
 * @property-read int|null $courses_count
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|CourseType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseType query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseType whereUpdatedAt($value)
 */
	class IdeHelperCourseType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CourseYear
 *
 * @mixin IdeHelperCourseYear
 * @property int $id
 * @property int $semester_id
 * @property int $course_id
 * @property int|null $evento_id
 * @property string $number
 * @property string|null $name
 * @property bool $is_audit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\BaseCollection|\App\Models\Lesson[] $lessons
 * @property-read int|null $lessons_count
 * @property-read \App\Models\Semester $semester
 * @property-read \App\Models\BaseCollection|\App\Models\SkillStundent[] $skillStudents
 * @property-read int|null $skill_students_count
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|CourseYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseYear whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseYear whereEventoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseYear whereIsAudit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseYear whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseYear whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseYear whereSemesterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseYear whereUpdatedAt($value)
 */
	class IdeHelperCourseYear extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CrossQualification
 *
 * @mixin IdeHelperCrossQualification
 * @property int $id
 * @property int|null $janis_id
 * @property int $study_field_id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BaseCollection|\App\Models\CrossQualificationYear[] $crossQualificationYears
 * @property-read int|null $cross_qualification_years_count
 * @property-read \App\Models\BaseCollection|\App\Models\Planning[] $plannings
 * @property-read int|null $plannings_count
 * @property-read \App\Models\BaseCollection|\App\Models\Recommendation[] $recommendations
 * @property-read int|null $recommendations_count
 * @property-read \App\Models\StudyField $studyField
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualification query()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualification whereJanisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualification whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualification whereStudyFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualification whereUpdatedAt($value)
 */
	class IdeHelperCrossQualification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CrossQualificationYear
 *
 * @mixin IdeHelperCrossQualificationYear
 * @property int $id
 * @property int|null $assessment_id
 * @property int $cross_qualification_id
 * @property int|null $recommendation_id
 * @property int|null $assessment_id
 * @property int $study_field_year_id
 * @property int|null $amount_to_pass
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Assessment|null $assessment
 * @property-read \App\Models\BaseCollection|\App\Models\Course[] $courses
 * @property-read int|null $courses_count
 * @property-read \App\Models\CrossQualification $crossQualification
 * @property-read \App\Models\Recommendation|null $recommendation
 * @property-read \App\Models\StudyFieldYear $studyFieldYear
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualificationYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualificationYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualificationYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualificationYear whereAmountToPass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualificationYear whereAssessmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualificationYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualificationYear whereCrossQualificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualificationYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualificationYear whereRecommendationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualificationYear whereStudyFieldYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossQualificationYear whereUpdatedAt($value)
 */
	class IdeHelperCrossQualificationYear extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Event
 *
 * @mixin IdeHelperEvent
 * @property-read \App\Models\BaseCollection|\App\Models\Completion[] $completions
 * @property-read int|null $completions_count
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\BaseCollection|\App\Models\Lesson[] $lessons
 * @property-read int|null $lessons_count
 * @property-read \App\Models\Semester $semester
 * @property-read \App\Models\BaseCollection|\App\Models\SkillStundent[] $skillStudent
 * @property-read int|null $skill_student_count
 * @property-read \App\Models\BaseCollection|\App\Models\Skill[] $skillStudentSkills
 * @property-read int|null $skill_student_skills_count
 * @property-read \App\Models\BaseCollection|\App\Models\Student[] $skillStudentStudents
 * @property-read int|null $skill_student_students_count
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 */
	class IdeHelperEvent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Language
 *
 * @mixin IdeHelperLanguage
 * @property int $id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BaseCollection|\App\Models\Course[] $courses
 * @property-read int|null $courses_count
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language query()
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereUpdatedAt($value)
 */
	class IdeHelperLanguage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Lesson
 *
 * @mixin IdeHelperLesson
 * @property int $id
 * @property int $course_year_id
 * @property string $start_date
 * @property string $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CourseYear $courseYear
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereCourseYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereUpdatedAt($value)
 */
	class IdeHelperLesson extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Mentor
 *
 * @mixin IdeHelperMentor
 * @property int $id
 * @property string $evento_person_id_hash
 * @property string|null $firstname
 * @property string|null $lastname
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BaseCollection|\App\Models\MentorStudent[] $mentorStudent
 * @property-read int|null $mentor_student_count
 * @property-read \App\Models\BaseCollection|\App\Models\Planning[] $plannings
 * @property-read int|null $plannings_count
 * @property-read \App\Models\BaseCollection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @property-read \App\Models\User|null $user
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereEventoPersonIdHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mentor whereUpdatedAt($value)
 */
	class IdeHelperMentor extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MentorStudent
 *
 * @mixin IdeHelperMentorStudent
 * @property int $id
 * @property int $mentor_id
 * @property int $student_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Mentor $mentor
 * @property-read \App\Models\Student $student
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|MentorStudent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MentorStudent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MentorStudent query()
 * @method static \Illuminate\Database\Eloquent\Builder|MentorStudent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MentorStudent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MentorStudent whereMentorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MentorStudent whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MentorStudent whereUpdatedAt($value)
 */
	class IdeHelperMentorStudent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Planning
 *
 * @mixin IdeHelperPlanning
 * @property int $id
 * @property int|null $cross_qualification_year_id
 * @property int|null $mentor_id
 * @property int|null $specialization_year_id
 * @property int $student_id
 * @property int $study_field_year_id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BaseCollection|\App\Models\CoursePlanning[] $coursePlannings
 * @property-read int|null $course_plannings_count
 * @property-read \App\Models\BaseCollection|\App\Models\Course[] $courses
 * @property-read int|null $courses_count
 * @property-read \App\Models\CrossQualificationYear|null $crossQualificationYear
 * @property-read \App\Models\Mentor|null $mentor
 * @property-read \App\Models\BaseCollection|\App\Models\Semester[] $semesters
 * @property-read int|null $semesters_count
 * @property-read \App\Models\SpecializationYear|null $specializationYear
 * @property-read \App\Models\Student $student
 * @property-read \App\Models\StudyFieldYear $studyFieldYear
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Planning newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Planning newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Planning query()
 * @method static \Illuminate\Database\Eloquent\Builder|Planning whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Planning whereCrossQualificationYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Planning whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Planning whereMentorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Planning whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Planning whereSpecializationYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Planning whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Planning whereStudyFieldYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Planning whereUpdatedAt($value)
 */
	class IdeHelperPlanning extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Recommendation
 *
 * @mixin IdeHelperRecommendation
 * @property int $id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BaseCollection|\App\Models\CourseRecommendation[] $courseRecommendations
 * @property-read int|null $course_recommendations_count
 * @property-read \App\Models\BaseCollection|\App\Models\Course[] $courses
 * @property-read int|null $courses_count
 * @property-read \App\Models\CrossQualificationYear $crossQualificationYear
 * @property-read Recommendation $originRecommendation
 * @property-read \App\Models\BaseCollection|\App\Models\Semester[] $semesters
 * @property-read int|null $semesters_count
 * @property-read \App\Models\SpecializationYear $specializationYear
 * @property-read \App\Models\StudyFieldYear $studyFieldYear
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereUpdatedAt($value)
 */
	class IdeHelperRecommendation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Schedule
 *
 * @mixin IdeHelperSchedule
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule query()
 */
	class IdeHelperSchedule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Semester
 *
 * @mixin IdeHelperSemester
 * @property int $id
 * @property int|null $previous_semester_id
 * @property int $year
 * @property bool $is_hs
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BaseCollection|\App\Models\Assessment[] $assessments
 * @property-read int|null $assessments_count
 * @property-read \App\Models\BaseCollection|\App\Models\Course[] $coursePlanningCourses
 * @property-read int|null $course_planning_courses_count
 * @property-read \App\Models\BaseCollection|\App\Models\Planning[] $coursePlanningPlannings
 * @property-read int|null $course_planning_plannings_count
 * @property-read \App\Models\BaseCollection|\App\Models\Course[] $courseRecommendationCourses
 * @property-read int|null $course_recommendation_courses_count
 * @property-read \App\Models\BaseCollection|\App\Models\Recommendation[] $courseRecommendationRecommendations
 * @property-read int|null $course_recommendation_recommendations_count
 * @property-read Semester|null $previousSemester
 * @property-read \App\Models\BaseCollection|\App\Models\Recommendation[] $recommendations
 * @property-read int|null $recommendations_count
 * @property-read \App\Models\BaseCollection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Semester newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester query()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereIsHs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester wherePreviousSemesterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereYear($value)
 */
	class IdeHelperSemester extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Skill
 *
 * @mixin IdeHelperSkill
 * @property int $id
 * @property int $taxonomy_id
 * @property string $definition
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BaseCollection|\App\Models\CourseSkill[] $courseSkill
 * @property-read int|null $course_skill_count
 * @property-read \App\Models\BaseCollection|\App\Models\Course[] $courses
 * @property-read int|null $courses_count
 * @property-read \App\Models\BaseCollection|\App\Models\SkillStundent[] $skillStudent
 * @property-read int|null $skill_student_count
 * @property-read \App\Models\BaseCollection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @property-read \App\Models\Taxonomy $taxonomy
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Skill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Skill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Skill query()
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereDefinition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereTaxonomyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereUpdatedAt($value)
 */
	class IdeHelperSkill extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SkillStundent
 *
 * @mixin IdeHelperSkillStundent
 * @property int $id
 * @property int $skill_id
 * @property int $student_id
 * @property int $course_year_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CourseYear $courseYear
 * @property-read \App\Models\Skill $skill
 * @property-read \App\Models\Student $student
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|SkillStundent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SkillStundent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SkillStundent query()
 * @method static \Illuminate\Database\Eloquent\Builder|SkillStundent whereCourseYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillStundent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillStundent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillStundent whereSkillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillStundent whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SkillStundent whereUpdatedAt($value)
 */
	class IdeHelperSkillStundent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Specialization
 *
 * @mixin IdeHelperSpecialization
 * @property int $id
 * @property int|null $janis_id
 * @property int $study_field_id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BaseCollection|\App\Models\SpecializationYear[] $specializationYears
 * @property-read int|null $specialization_years_count
 * @property-read \App\Models\StudyField $studyField
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization query()
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization whereJanisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization whereStudyFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization whereUpdatedAt($value)
 */
	class IdeHelperSpecialization extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SpecializationYear
 *
 * @mixin IdeHelperSpecializationYear
 * @property int $id
 * @property int|null $assessment_id
 * @property int|null $recommendation_id
 * @property int $specialization_id
 * @property int $study_field_year_id
 * @property int|null $assessment_id
 * @property int|null $amount_to_pass
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Assessment|null $assessment
 * @property-read \App\Models\BaseCollection|\App\Models\CourseSpecializationYear[] $courseSpecializationYear
 * @property-read int|null $course_specialization_year_count
 * @property-read \App\Models\BaseCollection|\App\Models\Course[] $courses
 * @property-read int|null $courses_count
 * @property-read \App\Models\Recommendation|null $recommendation
 * @property-read \App\Models\Specialization $specialization
 * @property-read \App\Models\StudyFieldYear $studyFieldYear
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|SpecializationYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SpecializationYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SpecializationYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|SpecializationYear whereAmountToPass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecializationYear whereAssessmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecializationYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecializationYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecializationYear whereRecommendationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecializationYear whereSpecializationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecializationYear whereStudyFieldYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecializationYear whereUpdatedAt($value)
 */
	class IdeHelperSpecializationYear extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Student
 *
 * @mixin IdeHelperStudent
 * @property int $id
 * @property int|null $study_field_year_id
 * @property string $evento_person_id_hash
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Semester $beginSemester
 * @property-read \App\Models\BaseCollection|\App\Models\Completion[] $completions
 * @property-read int|null $completions_count
 * @property-read \App\Models\BaseCollection|\App\Models\MentorStudent[] $mentorStudent
 * @property-read int|null $mentor_student_count
 * @property-read \App\Models\BaseCollection|\App\Models\Mentor[] $mentors
 * @property-read int|null $mentors_count
 * @property-read \App\Models\BaseCollection|\App\Models\Planning[] $plannings
 * @property-read int|null $plannings_count
 * @property-read \App\Models\BaseCollection|\App\Models\SkillStundent[] $skillStudent
 * @property-read int|null $skill_student_count
 * @property-read \App\Models\BaseCollection|\App\Models\Event[] $skillStudentEvents
 * @property-read int|null $skill_student_events_count
 * @property-read \App\Models\BaseCollection|\App\Models\Skill[] $skills
 * @property-read int|null $skills_count
 * @property-read \App\Models\StudyFieldYear|null $studyFieldYear
 * @property-read \App\Models\User|null $user
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereEventoPersonIdHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereStudyFieldYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUpdatedAt($value)
 */
	class IdeHelperStudent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StudyField
 *
 * @mixin IdeHelperStudyField
 * @property int $id
 * @property int|null $study_program_id
 * @property int|null $evento_id
 * @property string|null $evento_number
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BaseCollection|\App\Models\Course[] $courses
 * @property-read int|null $courses_count
 * @property-read \App\Models\BaseCollection|\App\Models\Specialization[] $specializations
 * @property-read int|null $specializations_count
 * @property-read \App\Models\BaseCollection|\App\Models\StudyFieldYear[] $studyFieldYears
 * @property-read int|null $study_field_years_count
 * @property-read \App\Models\StudyProgram|null $studyProgram
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|StudyField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyField query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyField whereEventoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyField whereEventoNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyField whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyField whereStudyProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyField whereUpdatedAt($value)
 */
	class IdeHelperStudyField extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StudyFieldYear
 *
 * @mixin IdeHelperStudyFieldYear
 * @property int $id
 * @property int|null $assessment_id
 * @property int $begin_semester_id
 * @property int|null $origin_study_field_year_id
 * @property int|null $recommendation_id
 * @property int $study_field_id
 * @property int|null $evento_id
 * @property string|null $evento_number
 * @property bool $is_specialization_mandatory
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Assessment|null $assessment
 * @property-read \App\Models\Semester $beginSemester
 * @property-read \App\Models\BaseCollection|\App\Models\CourseGroupYear[] $courseGroupYears
 * @property-read int|null $course_group_years_count
 * @property-read StudyFieldYear|null $originStudyFieldYear
 * @property-read \App\Models\Recommendation|null $recommendation
 * @property-read \App\Models\StudyField $studyField
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|StudyFieldYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyFieldYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyFieldYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyFieldYear whereAssessmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyFieldYear whereBeginSemesterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyFieldYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyFieldYear whereEventoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyFieldYear whereEventoNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyFieldYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyFieldYear whereIsSpecializationMandatory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyFieldYear whereOriginStudyFieldYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyFieldYear whereRecommendationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyFieldYear whereStudyFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyFieldYear whereUpdatedAt($value)
 */
	class IdeHelperStudyFieldYear extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StudyProgram
 *
 * @mixin IdeHelperStudyProgram
 * @property int $id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BaseCollection|\App\Models\StudyField[] $studyFields
 * @property-read int|null $study_fields_count
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram whereUpdatedAt($value)
 */
	class IdeHelperStudyProgram extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Taxonomy
 *
 * @mixin IdeHelperTaxonomy
 * @property int $id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BaseCollection|\App\Models\Skill[] $skills
 * @property-read int|null $skills_count
 * @method static \App\Models\BaseCollection|static[] all($columns = ['*'])
 * @method static \App\Models\BaseCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy query()
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereUpdatedAt($value)
 */
	class IdeHelperTaxonomy extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @mixin IdeHelperUser
 * @property int $id
 * @property string $email_hash
 * @property int|null $mentor_id
 * @property int|null $student_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Mentor|null $mentor
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\Student|null $student
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMentorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class IdeHelperUser extends \Eloquent {}
}

