import Vue from "vue";
import Component from "vue-class-component";
import {CoursePlanningModel} from "../../store/coursePlanning/coursePlanning.model";
import {CourseModel} from "../../store/course/course.model";
import {SemesterModel} from "../../store/semester/semester.model";
import {SkillModel} from "../../store/skill/skill.model";

// Define a super class component
@Component
export default class BaseComponent extends Vue {
    public models = {
        coursePlanning: new CoursePlanningModel(this.$store),
        course: new CourseModel(this.$store),
        semester: new SemesterModel(this.$store),
        skill: new SkillModel(this.$store),
    }

}
