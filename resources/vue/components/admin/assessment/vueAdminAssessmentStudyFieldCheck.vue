<template>
    <vue-card v-if="studyFieldYear">
        <template v-slot:title>

        </template>
    </vue-card>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../../base/baseComponent";
import VueCard from "../../base/vueCard.vue";
import VueAdminAssessmentEdit from "./vueAdminAssessmentEdit.vue";
import {ICourseGroupYear} from "../../../interfaces/courseGroupYear.interface";

@Component({
    components: {
        VueCard,
        VueAdminAssessmentEdit
    }
})
export default class VueAdminAssessment extends BaseComponent {
    @Prop({type: Number})
    public assessmentId: number

    @Propt({type: Number})
    public studyFieldYearId: number

    public get studyFieldYear() {
        return this.models.studyFieldYear.getById(this.studyFieldYearId);
    }

    public get semester() {
        this.models.semester.getById()
    }

    public get assessmentCourses() {
        return this.models.assessmentCourse.filter(assessmentCourse => assessmentCourse.assessment_id === this.assessmentId);
    }

    public get courseGroupYears(): ICourseGroupYear[] {
        return this.models.courseGroupYear.filter(courseGroupYear => courseGroupYear.study_field_year_id === this.studyFieldYearId)
    }

    public get courseGroupYearIds() {
        return this.courseGroupYears.map(courseGroupYear => courseGroupYear.id);
    }

    public get courseCourseGroupYears() {
        return this.models.courseCourseGroupYear.filter(courseCourseGroupYear => this.courseGroupYearIds.includes(courseCourseGroupYear.course_group_year_id))
    }

    public get courseCourseGroupYearCourseIds() {
        return this.courseCourseGroupYears.map(courseCourseGroupYear => courseCourseGroupYear.course_id);
    }

    public get coursesNotInStudyFieldYear() {
        return this.assessmentCourses.filter(assessmentCourse => !this.courseCourseGroupYearCourseIds.includes(assessmentCourse.course_id))
    }

}
</script>
