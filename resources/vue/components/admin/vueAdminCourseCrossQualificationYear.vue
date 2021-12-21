<template>
    <div class="space-y-2">
        <div class="p-2 rounded  bg-white flex flex-col shadow-xl">
            <div class="p-3 text-sm md:text-base flex-grow">
                <div class="flex flex-col space-y-4">
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
        </div>
        <div v-for="course in courses" class="p-2 rounded  bg-white flex flex-col shadow-xl">
            <div class="p-3 text-sm md:text-base flex-grow">

                <div>
                    {{ course.number_unformated }}
                </div>
                <div>
                    {{ course.name }}
                </div>


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

}
</script>
