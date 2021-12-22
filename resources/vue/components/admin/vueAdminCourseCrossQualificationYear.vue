<template>
    <div>
        <div v-for="{id, course_id} in courseCrossQualificationYears">
            <div v-if="getCourse(course_id)" class="flex flex-row space-x-4">
                <span class="w-8" @click="()=>remove(id)">
                  <i aria-hidden="true" class="far fa-trash alt mr-2 cursor-pointer text-red-500"> </i>
                </span>
                <div class="w-28">
                    {{ getCourse(course_id).number_unformated }}
                </div>
                <div>
                    {{ getCourse(course_id).name }}

                </div>
            </div>
        </div>
        <div class="flex flex-row space-x-4 mt-8">
            <vue-backend-select
                v-model="selectedCourse"
                :backend-search-url="'/webapi/courses'"
                :disabled="isAdding"
                :get-backend-search-params="getCourseSearchParams"
                :label="'Modul'"
                :selectable="courseIsSelectable"
                :show-option="getFullCourseName"
                class="w-full"
            ></vue-backend-select>
            <div class="w-full text-center">
                <button :class="{'cursor-not-allowed': isAdding}" :disabled="isAdding" class="button-primary"
                        @click="addCourse">
                    Hinzufügen
                </button>
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
import axios from "axios";
import {Toast} from "../../helpers/toast";
import {ICourseCrossQualificationYear} from "../../interfaces/courseCrossQualificationYear.interface";

@Component({
    components: {VueToggleMentorStudyField, VueBackendSelect}
})
export default class VueAdminCourseCrossQualificationYear extends BaseComponent {

    @Prop({type: Object})
    public crossQualificationYear: ICrossQualificationYear


    @Prop({type: Array})
    public initCourseCrossQualificationYears: ICourseCrossQualificationYear[]

    public courseCrossQualificationYears: ICourseCrossQualificationYear[] = []
    public selectedCourse: ICourse = null;

    public isAdding = false;

    public created() {
        this.courseCrossQualificationYears = this.initCourseCrossQualificationYears;
    }

    public getCourseSearchParams(search: string) {
        return {search}
    }

    public addCourse() {
        if (!this.selectedCourse) {
            return;
        }

        if (this.courseCrossQualificationYears.find(courseCrossQualificationYear => courseCrossQualificationYear.course_id === this.selectedCourse.id)) {
            return;
        }
        this.models.course.add(this.selectedCourse);

        this.courseCrossQualificationYears.push({
            id: 0,
            course_id: this.selectedCourse.id,
            cross_qualification_year_id: this.crossQualificationYear.id
        })
        axios.post<ICourseCrossQualificationYear>('/webapi/coursecrossqualificationyears', {
            course_id: this.selectedCourse.id,
            cross_qualification_year_id: this.crossQualificationYear.id
        }).then((res) => {
            this.removeZeroCourseCrossQualificationYear();
            this.courseCrossQualificationYears.push(res.data)
            Toast.fire({
                text: 'Modul hinzugefügt',
                icon: 'success'
            })
        }).catch(() => {
            this.removeZeroCourseCrossQualificationYear();
            Toast.fire({
                text: 'Modul konnte nicht hinzugefügt werden',
                icon: 'error'
            });
        })

    }

    public getFullCourseName(course: ICourse) {
        return course.number_unformated + ': ' + course.name;
    }

    public courseIsSelectable(course: ICourse): boolean {
        return !this.courseCrossQualificationYears.find(pivotCourse => pivotCourse.id === course.id);


    }

    public remove(courseCrossQualificationYearId: number) {
        const courseCrossQualificationYear = this.courseCrossQualificationYears.find(ccqy => ccqy.id === courseCrossQualificationYearId);
        const index = this.courseCrossQualificationYears.findIndex((ccqy) => ccqy.id === courseCrossQualificationYearId);
        if (index === -1) {
            return;
        }
        this.courseCrossQualificationYears.splice(index, 1);
        axios.delete(`/webapi/coursecrossqualificationyears/${courseCrossQualificationYearId}`)
            .then(() => {
                Toast.fire({
                    text: 'Modul entfernt',
                    icon: 'success'
                })
            })
            .catch(() => {
                this.courseCrossQualificationYears.splice(index, 0, courseCrossQualificationYear);
                Toast.fire({
                    text: 'Modul konnte nicht entfernt werden',
                    icon: 'error'
                });
            })
    }

    public removeZeroCourseCrossQualificationYear() {
        const index = this.courseCrossQualificationYears.findIndex(courseCrossQualificationYear => courseCrossQualificationYear.id === 0);
        if (index === -1) {
            return;
        }
        this.courseCrossQualificationYears.splice(index, 1);
    }

    public getCourse(courseId: number) {
        return this.models.course.getById(courseId)
    }

}
</script>
