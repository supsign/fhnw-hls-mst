<template>
    <vue-card v-if="courseGroup">
        <template slot="title">
            {{courseGroup.name}}
        </template>
        <div>
            <vue-admin-course-course-group
                v-for="courseCourseGroupYear in courseCourseGroupYears"
                :key="courseCourseGroupYear.id"
                :course-course-group-year="courseCourseGroupYear"
                @remove="remove"
            />
            <vue-admin-backend-course-select
                v-model="selectedCourse"
                :disabled="!!selectedCourse"
                @input="addCourse"
                :course-ids-in-use="courseIdsInUse"
            ></vue-admin-backend-course-select>
        </div>
    </vue-card>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ICourseGroupYear} from "../../interfaces/courseGroupYear.interface";
import VueCard from "../base/vueCard.vue";
import VueAdminCourseCourseGroup from "./vueAdminCourseCourseGroup.vue";
import {ICourse} from "../../interfaces/course.interface";
import {ICourseCourseGroupYear} from "../../store/courseCourseGroupYear/courseCourseGroupYear.interface";
import VueAdminBackendCourseSelect from "./vueAdminBackendCourseSelect.vue";

@Component({
    components: {VueAdminBackendCourseSelect, VueAdminCourseCourseGroup, VueCard}
})
export default class VueAdminCourseCourseGroups extends BaseComponent {

    @Prop({type: Object})
    public courseGroupYear: ICourseGroupYear

    public selectedCourse:ICourse = null;

    public get courseGroup () {
        return this.models.courseGroup.getById(this.courseGroupYear.course_group_id)
    }

    public get courseCourseGroupYears ():ICourseCourseGroupYear[] {
        return this.models.courseCourseGroupYear.all.filter(courseCourseGroupYear => courseCourseGroupYear.course_group_year_id === this.courseGroupYear.id)
    }

    public get courseIdsInUse() {
        return this.courseCourseGroupYears.map(courseCourseGroupYear => courseCourseGroupYear.course_id);
    }

    public remove(courseCourseGroupYear: ICourseCourseGroupYear) {
        this.models.courseCourseGroupYear.delete(courseCourseGroupYear.id);
    }

    public addCourse() {
        if (!this.selectedCourse) {
            return;
        }

        if (this.courseCourseGroupYears.find(courseCourseGroupYears => courseCourseGroupYears.course_id === this.selectedCourse.id)) {
            return;
        }

        this.models.course.add(this.selectedCourse);

        this.models.courseCourseGroupYear.post(
            {
                course_id:this.selectedCourse.id,
                course_group_year_id: this.courseGroupYear.id
            }).finally(() => {
                console.log('blub')
                this.selectedCourse = null;
            });
    }


}
</script>
