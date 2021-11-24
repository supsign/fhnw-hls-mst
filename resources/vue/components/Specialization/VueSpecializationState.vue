<template>
    <div>
        <div v-for="course in specializationCourses" class="mb-1 flex flex-row justify-between">
            <div>{{ course.name }}</div>
            <div v-if="coursesIsCompletedSusscessfully(course)" class="my-auto"><i class="far fa-check-circle" aria-hidden="true"></i></div>
            <div class="flex flex-row space-x-1"
                 v-else-if="courseIsPlanned(course)">
                <div>{{ coursePlanningSemester(course) }}</div>
                <div>{{ coursePlanningSemesterHsFs(course) }}</div>
            </div>
            <div v-else class="my-auto"><i class="far fa-circle " aria-hidden="true"></i></div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ICompletion} from "../../interfaces/completion.interface";
import {ICourse} from "../../interfaces/course.interface"
import {ICoursePlanning} from "../../store/coursePlanning/coursePlanning.interface";
import {ISpecialization} from "../../interfaces/specialization.interface";
import {ISpecializationYear} from "../../interfaces/specialzationYear.interface";
import {ISemester} from "../../interfaces/semester.interface";

@Component
export default class VueSpecializationState extends BaseComponent {
    @Prop({type: Number})
    public planningId: number

    @Prop({type: Object})
    public planning: ICoursePlanning

    @Prop({type: Array})
    public completions: ICompletion[]

    @Prop({type: Array})
    public semesters: ISemester[]

    @Prop({type: Object})
    public specialization: ISpecialization

    @Prop({type: Object})
    public specializationYear?: ISpecializationYear

    @Prop({type: Array})
    public specializationCourses: ICourse[]

    public showSpecialization = false;

    public get coursePlannings(): ICoursePlanning[] {
        return this.models.coursePlanning.byPlanningId(this.planningId)
    }

    public get courseAmounts(): number {
        let courseAmounts = 0;
        for (const course of this.specializationCourses) {
            if (this.coursesIsCompletedSusscessfully(course)) {
                courseAmounts++;
                continue;
            }

            if (this.courseIsPlanned(course)) {
                courseAmounts++;
            }
        }

        return courseAmounts;
    }

    public coursesIsCompletedSusscessfully(course: ICourse): boolean {
        return !!this.completions.find((completion) => {
            return completion.course_id === course.id && (completion.completion_type_id === 2 || completion.completion_type_id === 4)
        })
    }

    public courseIsPlanned(course: ICourse): boolean {
        return !!this.coursePlannings.find(coursePlanning => coursePlanning.course_id === course.id)
    }

    public coursePlanningSemester(course: ICourse) {
        const semesterId = this.coursePlannings.find(semesterId => semesterId.course_id === course.id).semester_id;
        return this.semesters.find(semester => semester.id === semesterId).year -2000;
    }

    public coursePlanningSemesterHsFs(course: ICourse) {
        const semesterId = this.coursePlannings.find(semesterId => semesterId.course_id === course.id).semester_id;
        return this.semesters.find(semester => semester.id === semesterId).is_hs  ? 'HS' : 'FS';
    }

}
</script>
