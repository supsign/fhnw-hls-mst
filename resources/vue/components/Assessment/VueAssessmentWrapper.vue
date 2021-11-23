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
            ></vue-assessment-state>
        </div>
       <div class="md:w-full mx-auto grid grid-cols-3">
           <div></div>
           <div>
               <div>{{ courseAmounts }}&nbsp;|&nbsp;{{ assessment.amount_to_pass }}</div>
               <div>Assessment</div>
           </div>
           <div class="text-center border-l text-sm hover:bg-hls" @click="toggleShowAssessment">
               <div>{{ courseAmounts }}&nbsp;|&nbsp;{{ assessment.amount_to_pass }}</div>
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

    public showAssessment = false;

    public toggleShowAssessment() {
        this.showAssessment = !this.showAssessment;
    }
}
</script>

