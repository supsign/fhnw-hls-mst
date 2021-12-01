<template>
    <div v-if="semesterIsInPlanning"
         class="p-2 bg-white rounded shadow mb-4">
        <div class="flex flex-row space-x-3 p-1" @click="toggleCollapse">
            <div class="my-auto">
                <i v-if="isCollapsed" aria-hidden="true" class="fas fa-arrow-right"></i>
                <i v-if="!isCollapsed" aria-hidden="true" class="fas fa-arrow-down"></i>
            </div>
            <div class="sm:text-sm lg:text-base">{{ semester.is_hs ? 'HS' : 'FS' }} {{ semester.year}}</div>
        </div>

        <div v-if="!isCollapsed"
             v-for="coursePlanning in allCoursePlanningsInSemester"
             class="ml-5 sm:text-sm lg:text-base flex flex-col pt-2 mt-2 pb-0 text-sm lg:text-base border-t">
            successfull: {{ coursesIsCompletedSuccessfully(getCourse(coursePlanning)) }} <br/>
            grösser gleich jetzt: {{ semester.year >= currentYear }}<br/>
            kleiner gleich jetzt: {{ semester.year <= currentYear }}

            <div v-if="semester.year >= currentYear || coursesIsCompletedSuccessfully(getCourse(coursePlanning)) && semester.year <= currentYear">

                <div>Kursname: </div>
                <div class="ml-5">Kurs-Nummer: </div>
                <div class="ml-5">ECTS: </div>
                <div class="ml-5">Kurs-ID: {{ coursePlanning.course_id }}</div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ISemester} from "../../interfaces/semester.interface";
import {ICoursePlanning} from "../../store/coursePlanning/coursePlanning.interface";
import {ICompletion} from "../../interfaces/completion.interface";
import {ICourse} from "../../interfaces/course.interface";

@Component
export default class VuePlanningSemester extends BaseComponent {
    @Prop({type: Object})
    public semester: ISemester

    @Prop({type: Object})
    public planning: ICoursePlanning

    @Prop({type: Array})
    public completions: ICompletion[]

    @Prop({type: Array})
    public courses: ICourse[]

    public isCollapsed = true;
    public break = 1024;

    public toggleCollapse() {
        this.isCollapsed = !this.isCollapsed;
    }

    public expand() {
        this.isCollapsed = false;
    }

    public handlerResize() {
        if (window.innerWidth > this.break) {
            this.expand();
        }
    }

    public mounted() {
        window.addEventListener('resize', this.handlerResize);
        this.handlerResize()
    }

    public destroyed() {
        window.removeEventListener('resize', this.handlerResize);
    }

    public get coursePlannings(): ICoursePlanning[] {
        return this.models.coursePlanning.byPlanningId(this.planning.id);
    }

    public get allCoursePlanningsInSemester(): ICoursePlanning[] {
        return this.coursePlannings.filter((coursePlanning) => coursePlanning.semester_id === this.semester.id);
    }

    public get semesterIsInPlanning(): ICoursePlanning {
        return this.allCoursePlanningsInSemester.find(coursePlanning => coursePlanning.semester_id === this.semester.id);
    }

    public coursesIsCompletedSuccessfully(course: ICourse): boolean {
        return !!this.completions.find((completion) => {
            return completion.course_id === course.id && (completion.completion_type_id === 2 || completion.completion_type_id === 4)
        })
    }

    public getCourse(coursePlanning: ICoursePlanning): ICourse {
        return this.courses.find(course => course.id === coursePlanning.course_id);
    }

    public get currentYear() {
        return new Date().getFullYear();
    }
}
</script>

