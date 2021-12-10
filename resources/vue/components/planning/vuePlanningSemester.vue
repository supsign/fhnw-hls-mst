<template>
    <div v-if="allCoursePlanningsInSemesterNotSuccessfullyCompleted.length">
        <div class="p-2 bg-white rounded shadow mb-4">
            <div
                class="flex flex-row space-x-3 p-1" @click="toggleCollapse">
                <div class="my-auto">
                    <i v-if="isCollapsed" aria-hidden="true" class="fas fa-arrow-right"></i>
                    <i v-if="!isCollapsed" aria-hidden="true" class="fas fa-arrow-down"></i>
                </div>
                <div class="flex justify-between w-full">
                    <div class="sm:text-sm lg:text-base">{{ semester.is_hs ? 'HS' : 'FS' }} {{ semester.year }}</div>
                    <div>{{ getAllPointsInSemester(semester) }} ECTS</div>
                </div>
            </div>

            <div v-if="!isCollapsed">
                <vue-course-detail v-for="coursePlanning in allCoursePlanningsInSemesterNotSuccessfullyCompleted"
                                   :key="coursePlanning.id"
                                   :courseId="coursePlanning.course_id"
                                   :planningId="planningId"
                                   :planningIsLocked="planningIsLocked"
                >

                    <template v-slot:icon>
                        <vue-completion :icon="completion(getCourse(coursePlanning))"
                        >

                        </vue-completion>
                    </template>
                </vue-course-detail>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import VueCourseDetail from "./vueCourseDetail.vue";
import {ISemester} from "../../interfaces/semester.interface";
import {ICoursePlanning} from "../../store/coursePlanning/coursePlanning.interface";
import {ICompletion} from "../../interfaces/completion.interface";
import {ICourse} from "../../interfaces/course.interface";
import VueCompletion from "./vueCompletion.vue";

@Component({
    components: {
        VueCompletion,
        VueCourseDetail
    }
})
export default class VuePlanningSemester extends BaseComponent {
    @Prop({type: Object})
    public semester: ISemester

    @Prop({type: Number})
    public planningId: number

    @Prop({type: Array})
    public completions: ICompletion[]

    @Prop({type: Array})
    public courses: ICourse[]

    @Prop({type: Boolean, default: false})
    planningIsLocked: boolean

    public isCollapsed = true;

    public break = 1024;

    public icon = 0;

    public course: ICourse;

    public get coursePlannings(): ICoursePlanning[] {
        return this.models.coursePlanning.byPlanningId(this.planningId);
    }

    public get allCoursePlanningsInSemester(): ICoursePlanning[] {
        return this.coursePlannings.filter((coursePlanning) => coursePlanning.semester_id === this.semester.id);
    }

    public get allCoursePlanningsInSemesterNotSuccessfullyCompleted() {
        return this.allCoursePlanningsInSemester.filter((coursePlanning) => {
            return !this.coursesIsCompletedSuccessfully(this.getCourse(coursePlanning))
        });
    }

    public get currentYear() {
        return new Date().getFullYear();
    }

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

    public coursesIsCompletedSuccessfully(course: ICourse): boolean {
        return !!this.completions.find((completion) => {
            return completion.course_id === course.id && (completion.completion_type_id === 2 || completion.completion_type_id === 4)
        })
    }

    public getCourse(coursePlanning: ICoursePlanning): ICourse {
        return this.courses.find(course => course.id === coursePlanning.course_id);
    }

    public getAllPointsInSemester(semester: ISemester) {
        let credits = 0;

        for (const course of this.courses) {
            for(const coursePlanning of this.coursePlannings) {
                if(coursePlanning.course_id === course.id && coursePlanning.semester_id === semester.id) {
                    credits += course.credits;
                }
            }
        }
        return credits;
    }

    public courseIsPlanned(course: ICourse): boolean {
        return !!this.coursePlannings.find(coursePlanning => coursePlanning.course_id === course.id)
    }

    public completion(course: ICourse) {
        let icon: number;

        if(!!this.completions.find((completion) => {
            return completion.course_id === course.id && (completion.completion_type_id === 2 || completion.completion_type_id === 4)
        })) {
            icon = 1
        }

        if(!!this.completions.find((completion) => {
            return completion.course_id === course.id && (completion.completion_type_id === 3)
        })) {
            icon = 2
        }

        else {
            icon = 3
        }

        return icon;
    }
}
</script>

