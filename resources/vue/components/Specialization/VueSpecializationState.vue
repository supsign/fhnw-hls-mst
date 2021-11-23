<template>
    <div v-if="specialisazion && specialisazionYear">
        <div class="border p-2 md:w-full p-2 mx-auto" @click="toggleShowAssessment">Spezialisierung: {{ courseAmounts }}&nbsp;/&nbsp;{{
                specialisazionYear.amount_to_pass
            }}
        </div>
        <div v-if="showSpecialization">
            <div v-for="course in specializationtCourses">
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
import {ICourse} from "../../interfaces/course.interface"
import {ICoursePlanning} from "../../store/coursePlanning/coursePlanning.interface";
import {ISpecialization} from "../../interfaces/specialization.interface";
import {ISpecializationYear} from "../../interfaces/specialzationYear.interface";

@Component
export default class VueSpecializationState extends BaseComponent {
    @Prop({type: Number})
    public planningId: number

    @Prop({type: Object})
    public specialisazion: ISpecialization

    @Prop({type: Object})
    public specialisazionYear: ISpecializationYear

    @Prop({type: Array})
    public specializationtCourses: ICourse[]

    @Prop({type: Array})
    public completions: ICompletion[]

    public showSpecialization = false;

    public get coursePlannings(): ICoursePlanning[] {
        return this.models.coursePlanning.byPlanningId(this.planningId)
    }

    public get courseAmounts(): number {
        let courseAmounts = 0;
        for (const course of this.specializationtCourses) {
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
        this.showSpecialization = !this.showSpecialization;
    }


}
</script>
