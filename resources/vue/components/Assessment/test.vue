<template>
    <div class="rounded border shadow-md fixed bottom-0 left-0 mt-2 w-full bg-hls-200"
         v-if="assessment">
        <div class="border-b text-sm lg:text-base p-3 bg-hls transition duration-200 ease-in-out"
             v-if="showAssessment">
            <vue-assessment-state :assessment="assessment"
                                  :assessment-courses="assessmentCourses"
                                  :completions="completions"
                                  :planning-id="planningId"
                                  :semesters="semesters"
                                  ref="assessmentState"
            ></vue-assessment-state>
        </div>
        <div class="md:w-full mx-auto grid grid-cols-3">
            <div></div>
            <div class="text-center border-l border-hls text-sm hover:bg-hls hover:border-gray-200">
                <div>{{  }}&nbsp;|&nbsp;{{ specialisationYear.amount_to_pass }}</div>
                <div>Specialisation</div>
            </div>
            <div class="text-center border-l border-hls text-sm hover:bg-hls hover:border-gray-200" @click="toggleShowAssessment">
                <div>{{ this.$refs.assessmentState }}&nbsp;|&nbsp;{{ assessment.amount_to_pass }}</div>
                <div>Assessment</div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import VueAssessmentState from "./VueAssessmentState.vue";
import {IAssessment} from "../../interfaces/assessment.interface";
import {ICourse} from "../../interfaces/course.interface";
import {ICompletion} from "../../interfaces/completion.interface";
import {ISemester} from "../../interfaces/semester.interface";
import {ISpecialization} from "../../interfaces/specialization.interface";
import {ISpecializationYear} from "../../interfaces/specialzationYear.interface";


@Component({
    components: {
        VueAssessmentState,

    }
})
export default class VueAssessmentWrapper extends BaseComponent {
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

    @Prop({type: Object})
    public specialisation: ISpecialization

    @Prop({type: Object})
    public specialisationYear: ISpecializationYear

    @Prop({type: Array})
    public specializationCourses: ICourse[]

    public showAssessment = false;

    public showSpecialization = false;

    public toggleShowAssessment() {
        this.showAssessment = !this.showAssessment;
    }
    public toggleShowSpecialization() {
        this.showSpecialization = !this.showSpecialization;
    }
    public created() {
        console.log(this.specialisationYear);
    }
}
</script>



