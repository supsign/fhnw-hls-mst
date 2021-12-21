<template>
    <div>
        <div v-for="course in courses" class="flex flex-row space-x-4">

            <span class="w-8" @click="()=>remove(course)">
                  <i aria-hidden="true" class="far fa-trash alt mr-2 cursor-pointer text-red-500"> </i>
            </span>
            <div class="w-28">
                {{ course.number_unformated }}
            </div>
            <div>
                {{ course.name }}

            </div>
        </div>
        <div class="flex flex-row space-x-4 mt-8">
            <vue-backend-select
                v-model="selectedCourse"
                :backend-search-url="'/webapi/courses'"
                :get-backend-search-params="getCourseSearchParams"
                :label="'Modul'"
                :selectable="courseIsSelectable"
                :show-option="getFullCourseName"
                class="w-full"
            ></vue-backend-select>
            <div class="w-full text-center">
                <button class="button-primary" @click="addCourse">Hinzufügen</button>
            </div>
        </div>
    </div>

</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import VueToggleMentorStudyField from "./vueToggleMentorStudyField.vue";
import {ICrossQualificationYear} from "../../interfaces/crossQualificationYear.interface";
import {ICourse} from "../../interfaces/course.interface";
import VueBackendSelect from "../form/backendSelect.vue";

@Component({
    components: {VueToggleMentorStudyField, VueBackendSelect}
})
export default class VueAdminCourseCrossQualificationYear extends BaseComponent {

    @Prop({type: Object})
    public crossQualificationYear: ICrossQualificationYear

    @Prop({type: Array})
    public initCourses: ICourse[]

    public courses: ICourse[] = []
    public selectedCourse: ICourse = null;

    public created() {
        this.courses = this.initCourses;
    }

    public getCourseSearchParams(search: string) {
        return {search}
    }

    public addCourse() {
        this.courses.push(this.selectedCourse)
        // todo axios call
    }

    public getFullCourseName(course: ICourse) {
        return course.number_unformated + ': ' + course.name;
    }

    public courseIsSelectable(course: ICourse): boolean {
        if (this.courses.find(pivotCourse => pivotCourse.id === course.id)) {
            return false;
        }

        return true;
    }

    public remove(course: ICourse) {
        const index = this.courses.findIndex((attachedCourse) => attachedCourse.id === course.id);
        if (index === -1) {
            return;
        }
        this.courses.splice(index, 1);
        // todo axios call
    }

}
</script>
