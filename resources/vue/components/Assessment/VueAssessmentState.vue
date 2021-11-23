<template>
    <div class="rounded border shadow-md fixed bottom-0 left-0 mt-2 w-full bg-hls-200"
         v-if="assessment">
        <div class="border-b text-sm lg:text-base p-3 bg-hls transition duration-200 ease-in-out"
             v-if="showAssessment">
            <div v-for="course in assessmentCourses" class="mb-1">
                <div class="flex flex-row justify-between">
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
        </div>
        <div class="md:w-full mx-auto grid grid-cols-3">
            <div></div>
            <div></div>
            <div class="text-center border-l border-hls text-sm hover:bg-hls hover:border-gray-200" @click="toggleShowAssessment">
                <div>{{ courseAmounts }}&nbsp;|&nbsp;{{ assessment.amount_to_pass }}</div>
                <div>Assessment</div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ICompletion} from "../../interfaces/completion.interface";
import {IAssessment} from "../../interfaces/assessment.interface";
import {ICourse} from "../../interfaces/course.interface"
import {ICoursePlanning} from "../../store/coursePlanning/coursePlanning.interface";
import {ISemester} from "../../interfaces/semester.interface";

@Component
export default class VueAssessmentState extends BaseComponent {
    @Prop({type: Number})
    public planningId: number

    @Prop({type: Object})
    public assessment: IAssessment

    @Prop({type: Array})
    public assessmentCourses: ICourse[]

    @Prop({type: Array})
    public completions: ICompletion[]

    @Prop({type: Array})
    public semesters: ISemester[]

    public showAssessment = false;

    public get coursePlannings(): ICoursePlanning[] {
        return this.models.coursePlanning.byPlanningId(this.planningId)
    }

    public get courseAmounts(): number {
        let courseAmounts = 0;
        for (const course of this.assessmentCourses) {
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

    public toggleShowAssessment() {
        this.showAssessment = !this.showAssessment;
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

