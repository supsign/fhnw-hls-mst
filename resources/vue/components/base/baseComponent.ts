import Vue from "vue";
import Component from "vue-class-component";
import {CoursePlanningModel} from "../../store/coursePlanning/coursePlanning.model";
import {CourseModel} from "../../store/course/course.model";
import {SemesterModel} from "../../store/semester/semester.model";
import {SkillModel} from "../../store/skill/skill.model";
import {SkillStudentModel} from "../../store/skillStudent/skillStudent.model";
import {courseSkillModel} from "../../store/courseSkill/courseSkill.model";
import {SpecializationModel} from "../../store/specialization/specialization.model";
import {SpecializationYearModel} from "../../store/specializationYear/specializationYear.model";
import {AssessmentModel} from "../../store/assessment/assessment.model";
import {CourseSpecializationYearModel} from "../../store/courseSpecializationYear/courseSpecializationYear.model";
import {CourseGroupYearModel} from "../../store/courseGroupYear/courseGroupYear.model";
import {CourseCourseGroupYearModel} from "../../store/courseCourseGroupYear/courseCourseGroupYear.model";
import {CourseGroupModel} from "../../store/courseGroup/courseGroup.model";
import {RecommendationModel} from "../../store/recommendation/recommendation.model";
import {CrossQualificationYearModel} from "../../store/crossQualificationYear/crossQualificationYear.model";
import {CourseCrossQualificationYearModel} from "../../store/courseCrossQualificationYear/courseCrossQualificationYear.model";
import {CrossQualificationModel} from "../../store/crossQualification/crossQualification.model";

// Define a super class component
@Component
export default class BaseComponent extends Vue {
    public models = {
        coursePlanning: new CoursePlanningModel(this.$store),
        course: new CourseModel(this.$store),
        semester: new SemesterModel(this.$store),
        skill: new SkillModel(this.$store),
        skillStudent: new SkillStudentModel(this.$store),
        courseSkill: new courseSkillModel(this.$store),
        specialization: new SpecializationModel(this.$store),
        specializationYear: new SpecializationYearModel(this.$store),
        assessment: new AssessmentModel(this.$store),
        courseSpecializationYear: new CourseSpecializationYearModel(this.$store),
        courseGroupYear: new CourseGroupYearModel(this.$store),
        courseCourseGroupYear: new CourseCourseGroupYearModel(this.$store),
        courseGroup: new CourseGroupModel(this.$store),
        recommendation: new RecommendationModel(this.$store),
        crossQualificationYear: new CrossQualificationYearModel(this.$store),
        courseCrossQualificationYear: new CourseCrossQualificationYearModel(this.$store),
        crossQualification: new CrossQualificationModel(this.$store)
    }

}
