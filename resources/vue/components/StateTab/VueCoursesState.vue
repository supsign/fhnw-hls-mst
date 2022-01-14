<template>
    <div
        class="text-center hover:bg-hls cursor-pointer">
        <div>{{ courseAmounts }}&nbsp;|&nbsp;{{ amountToPass }}</div>
        <div>{{ name }}</div>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ICompletion} from "../../interfaces/completion.interface";
import {ICourse} from "../../interfaces/course.interface"
import {ICoursePlanning} from "../../store/coursePlanning/coursePlanning.interface";

@Component
export default class VueCoursesState extends BaseComponent {
    @Prop({type: Number})
    public planningId: number

    @Prop({type: Number})
    public amountToPass: number

    @Prop({type: Array})
    public courses: ICourse[]

    @Prop({type: Array})
    public completions: ICompletion[]

    @Prop({type: String})
    public name: string


    public get coursePlannings(): ICoursePlanning[] {
        return this.models.coursePlanning.byPlanningId(this.planningId)
    }

    public get courseAmounts(): number {
        let courseAmounts = 0;
        for (const course of this.courses) {
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

}
</script>
