<template>
    <div class="rounded border shadow-md fixed bottom-0 left-0 mt-2 w-full bg-hls-200"
         v-if="assessment">
        <div class="border-b text-sm lg:text-base p-3 bg-hls transition duration-200 ease-in-out"
             :class=" { hidden: !showAssessment}"
             >
            <vue-assessment-state :assessment="assessment"
                                  :assessment-courses="assessmentCourses"
                                  :completions="completions"
                                  :planning-id="planningId"
                                  :semesters="semesters"
                                  ref="assessmentState"
            ></vue-assessment-state>
        </div>
        <div v-if="!specialisationActive"
             class="border-b text-sm lg:text-base p-3 bg-hls transition duration-200 ease-in-out"
             :class=" { hidden: !showSpecialization }"
        >
            <vue-specialization-state :assessment="assessment"
                                  :assessment-courses="assessmentCourses"
                                  :completions="completions"
                                  :planning-id="planningId"
                                  :semesters="semesters"
                                  ref="specialisationState"
            ></vue-specialization-state>
        </div>
        <div v-if="specialisationActive"
             class="border-b text-sm lg:text-base p-3 bg-hls transition duration-200 ease-in-out"
             :class=" { hidden: !showSpecialization }"
        >
            <vue-cross-qualification-state :assessment="assessment"
                                      :assessment-courses="assessmentCourses"
                                      :completions="completions"
                                      :planning-id="planningId"
                                      :semesters="semesters"
                                      ref="specialisationState"
            ></vue-cross-qualification-state>
        </div>
        <div class="md:w-full mx-auto grid grid-cols-3">
            <div></div>
            <div v-if="specialisationActive"
                 class="text-center border-l border-hls text-sm hover:bg-hls hover:border-gray-200" @click="toggleShowCrossQualification">
                <div>{{ assessmentAmount }}&nbsp;|&nbsp;{{ specialisationYear }}</div>
                <div>CrossQual.</div>
            </div>
            <div v-else
                 class="text-center border-l border-hls text-sm hover:bg-hls hover:border-gray-200" @click="toggleShowSpecialization">
                <div>{{ assessmentAmount }}&nbsp;|&nbsp;{{ specialisationYear }}</div>
                <div>Specialisation</div>
            </div>
            <div class="text-center border-l border-hls text-sm hover:bg-hls hover:border-gray-200" @click="toggleShowAssessment">
                <div>{{ assessmentAmount }}&nbsp;|&nbsp;{{ assessment.amount_to_pass }}</div>
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
import VueSpecializationState from "../Specialization/VueSpecializationState.vue";
import VueCrossQualificationState from "../CrossQualification/VueCrossQualificationState.vue";


@Component({
    components: {
        VueCrossQualificationState,
        VueAssessmentState,
        VueSpecializationState,
    }
})
export default class VueStateWrapper extends BaseComponent {
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

    public specialisationActive = false;

    public showAssessment = false;

    public showSpecialization = false;

    public showCrossQualification = false;

    public assessmentComponent: VueAssessmentState = null;

    public toggleShowAssessment() {
        this.showAssessment = !this.showAssessment;
    }

    public toggleShowSpecialization() {
        this.showSpecialization = !this.showSpecialization;
    }

    public toggleShowCrossQualification() {
        this.showCrossQualification = !this.showCrossQualification;
    }

    public created() {
        console.log(this.specialisationYear);
    }

    public mounted() {
        this.assessmentComponent = this.$refs.assessmentState as VueAssessmentState;
    }

    public get assessmentAmount() {
        if(!this.assessmentComponent) {
            return 0;
        }
        console.log(this.$refs);
        // @ts-ignore
        return this.assessmentComponent.courseAmounts;
    }
}
</script>



