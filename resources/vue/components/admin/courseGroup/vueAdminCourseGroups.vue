<template>
    <div class="grid gap-4">
        <vue-admin-course-course-groups
            v-for="courseGroupYear in courseGroupYears"
            :key="courseGroupYear.id"
            :course-group-year="courseGroupYear"
        />

        <vue-admin-create-course-group-year :study-field-year="studyFieldYear"/>
    </div>
</template>

<script lang="ts">
import { Component, Prop } from 'vue-property-decorator';
import BaseComponent from '../../base/baseComponent';
import VueAdminCourseCourseGroups from './vueAdminCourseCourseGroups.vue';
import { IStudyFieldYear } from '../../../interfaces/studyFieldYear.interface';
import VueAdminCreateCourseGroupYear from './vueAdminCreateCourseGroupYear.vue';

@Component({
    components: { VueAdminCourseCourseGroups, VueAdminCreateCourseGroupYear },
})
export default class VueAdminCourseGroups extends BaseComponent {
    @Prop({ type: Object })
    public studyFieldYear: IStudyFieldYear;

    public get courseGroupYears() {
        return this.models.courseGroupYear.all
            .filter((courseGroupYear) => courseGroupYear.study_field_year_id === this.studyFieldYear.id)
            .sort((a, b) => a.id - b.id);
    }
}
</script>
