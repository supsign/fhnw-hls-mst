<template>
    <div>
        <div class="mb-2">Semester {{ semester }}</div>
        <div class="text-sm space-y-2">
            <vue-admin-course-pivot-rec
                v-for="coursePivot in courseRecommendationsInSemester"
                :course-pivot="coursePivot"
                :key="coursePivot.id"
                @remove="remove"
                :is-hs="[1, 3, 5].includes(semester)"
            />
        </div>
        <vue-admin-backend-course-select
            v-model="selectedCourse"
            :disabled="!!selectedCourse"
            @input="addCourse(semester)"
            :course-ids-in-use="courseIdsInUse"
            class="mt-4"
        />
    </div>
</template>

<script lang="ts">
import { Component, Prop } from 'vue-property-decorator';
import BaseComponent from '../../base/baseComponent';
import VueCard from '../../base/vueCard.vue';
import { ICourse } from '../../../interfaces/course.interface';
import VueAdminBackendCourseSelect from '../vueAdminBackendCourseSelect.vue';
import { ICourseRecommendation } from '../../../interfaces/courseRecommendation.interface';
import VueAdminCoursePivotRec from '../vueAdminCoursePivotRec.vue';

@Component({
    components: {
        VueCard,
        VueAdminCoursePivotRec,
        VueAdminBackendCourseSelect,
    },
})
export default class VueAdminCourseRecommendations extends BaseComponent {
    @Prop({ type: Number })
    public recommendationId: number;

    @Prop({ type: Number })
    public semester: number;

    public selectedCourse: ICourse = null;

    public get courseRecommendations() {
        return this.models.courseRecommendation.filter(
            (courseRecommendation) => courseRecommendation.recommendation_id === this.recommendationId
        );
    }

    public get courseRecommendationsInSemester() {
        return this.courseRecommendations.filter(
            (courseRecommendation) => courseRecommendation.planned_semester === this.semester
        );
    }

    public remove(courseRecommendation: ICourseRecommendation) {
        this.models.courseRecommendation.delete(courseRecommendation.id);
    }

    public addCourse() {
        if (!this.selectedCourse) {
            return;
        }

        if (this.courseIdsInUse.includes(this.selectedCourse.id)) {
            return;
        }

        this.models.course.add(this.selectedCourse);

        this.models.courseRecommendation
            .post({
                course_id: this.selectedCourse.id,
                recommendation_id: this.recommendationId,
                planned_semester: this.semester,
            })
            .finally(() => {
                this.selectedCourse = null;
            });
    }

    public get courseIdsInUse() {
        return this.courseRecommendations.map((courseRecommendation) => courseRecommendation.course_id);
    }
}
</script>
