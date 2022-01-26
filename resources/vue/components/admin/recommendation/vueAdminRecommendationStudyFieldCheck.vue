<template>
    <vue-card v-if="studyFieldYear">
        <template v-slot:title>
            <div class="flex flex-row justify-between">
                <div>
                    {{ studyField.name }} - {{ semester.year }}
                </div>
                <div v-if="coursesNotInStudyFieldYear.length">
                    <a :href="`/admin/studyFieldYears/${studyFieldYearId}/courseGroups`" class="button-primary mt-8">
                        Module in Gruppen anpassen
                    </a>
                </div>
            </div>
        </template>
        <div v-if="coursesNotInStudyFieldYear.length">
            <div class="text-xs text-gray-600">Module, welche in der Studienrichtung fehlen:</div>
            <div v-for="courseRecommendation in coursesNotInStudyFieldYear">
                <div class="flex flex-row ml-4 text-sm">
                    <vue-admin-course :course-id="courseRecommendation.course_id"></vue-admin-course>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="text-sm text-gray-600">Alle Module in Studienrichtung enthalten</div>
        </div>
    </vue-card>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../../base/baseComponent";
import VueCard from "../../base/vueCard.vue";
import {ICourseGroupYear} from "../../../interfaces/courseGroupYear.interface";
import VueAdminCourse from "../vueAdminCourse.vue";

@Component({
    components: {
        VueCard,
        VueAdminCourse
    }
})
export default class VueAdminRecommendationStudyFieldCheck extends BaseComponent {
    @Prop({type: Number})
    public recommendationId: number

    @Prop({type: Number})
    public studyFieldYearId: number

    public get studyFieldYear() {
        return this.models.studyFieldYear.getById(this.studyFieldYearId);
    }

    public get studyField() {
        if (!this.studyFieldYear) {
            return;
        }
        return this.models.studyField.getById(this.studyFieldYear.study_field_id)
    }

    public get semester() {
        if (!this.studyFieldYear) {
            return;
        }
        return this.models.semester.getById(this.studyFieldYear.begin_semester_id);
    }

    public get courseRecommendations() {
        return this.models.courseRecommendation.filter(courseRecommendation => courseRecommendation.recommendation_id === this.recommendationId);
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
        return this.courseRecommendations.filter(courseRecommendation => !this.courseCourseGroupYearCourseIds.includes(courseRecommendation.course_id))
    }

}
</script>
