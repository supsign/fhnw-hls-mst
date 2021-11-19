<template>
    <div v-if="assessment">
        <div class="border p-2 md:w-full p-2 mx-auto" @click="toggleShowAssessment">Assessment: {{ courseAmounts }}&nbsp;/&nbsp;{{
                assessment.amount_to_pass
            }}
        </div>
        <div v-if="showAssessment">
            <div v-for="course in assessmentCourses">
                <div class="w-8">
                    <div v-if="coursesIsCompletedSusscessfully(course)">erfüllt</div>
                    <div v-else-if="courseIsPlanned(course)">geplant</div>
                    {{ course.name }}
                </div>
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


}
</script>

