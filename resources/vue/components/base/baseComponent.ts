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
    }

}
