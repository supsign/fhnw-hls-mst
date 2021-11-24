<template>
    <div class="rounded border shadow-md fixed bottom-0 left-0 mt-2 w-full bg-hls-200"
         v-if="assessment">
        <div class="border-b text-sm lg:text-base p-3 bg-hls transition duration-200 ease-in-out"
             :class=" { hidden: !showAssessment || showSpecialization}"
             >
            <vue-assessment-state :assessment="assessment"
                                  :assessment-courses="assessmentCourses"
                                  :completions="completions"
                                  :planning-id="planningId"
                                  :semesters="semesters"
                                  ref="assessmentState"
            ></vue-assessment-state>
        </div>
        <div v-if="specialisationActive"
             class="border-b text-sm lg:text-base p-3 bg-hls transition duration-200 ease-in-out"
             :class=" { hidden: !showSpecialization || showAssessment}"
        >
            <vue-specialization-state :specialisation="specialisation"
                                      :specialisation-year="specialisationYear"
                                      :specialisation-courses="specialisationCourses"
                                      :completions="completions"
                                      :planning-id="planningId"
                                      :semesters="semesters"
                                      :planning="planning"
                                      ref="specialisationState"
            ></vue-specialization-state>
        </div>
        <div v-if="crossQualificationActive"
             class="border-b text-sm lg:text-base p-3 bg-hls transition duration-200 ease-in-out"
             :class=" { hidden: !showSpecialization }"
        >
            <vue-cross-qualification-state :cross-qualification="specialisation"
                                           :cross-qualification-year="specialisationYear"
                                           :cross-qualification-courses="specialisationCourses"
                                           :completions="completions"
                                           :planning-id="planningId"
                                           :semesters="semesters"
                                           :planning="planning"
                                           ref="crossQualificationState"
            ></vue-cross-qualification-state>
        </div>
        <div v-else
        ></div>
        <div class="md:w-full mx-auto grid grid-cols-3">
            <div></div>
            <div v-if="crossQualificationActive"
                 class="text-center border-l border-hls text-sm hover:bg-hls hover:border-gray-200" @click="toggleShowCrossQualification">

                <div>CrossQual.</div>
            </div>
            <div v-if="specialisationActive"
                 class="text-center border-l border-hls text-sm hover:bg-hls hover:border-gray-200" @click="toggleShowSpecialization">
                <div>{{ specialisationAmount }}&nbsp;|&nbsp;{{ specialisationYear.amount_to_pass }}</div>
                <div>Specialisation</div>
            </div>
            <div v-else>

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
import {ICoursePlanning} from "../../store/coursePlanning/coursePlanning.interface";
import {ICrossQualification} from "../../interfaces/crossQualification.interface";
import {ICrossQualificationYear} from "../../interfaces/crossQualificationYear.interface";


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
    public planning: ICoursePlanning

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
    public specialisationYear?: ISpecializationYear

    @Prop({type: Array})
    public specialisationCourses: ICourse[]

    @Prop({type: Object})
    public crossQualification: ICrossQualification

    @Prop({type: Object})
    public crossQualificationYear?: ICrossQualificationYear

    @Prop({type: Array})
    public crossQualificationCourses: ICourse[]

    public specialisationActive = false;

    public crossQualificationActive = false;

    public showAssessment = false;

    public test: Array<ICoursePlanning> = [];

    public showSpecialization = false;

    public showCrossQualification = false;

    public assessmentComponent: VueAssessmentState = null;

    public specialisationComponent: VueSpecializationState = null;

    public crossQualificationComponent: VueCrossQualificationState = null;

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
        this.ccOrSpecialisationIsActive();
        console.log(this.specialisationActive);
        console.log(this.crossQualificationActive);
    }

    public mounted() {
        this.assessmentComponent = this.$refs.assessmentState as VueAssessmentState;
        this.specialisationComponent = this.$refs.specialisationState as VueSpecializationState;
        this.crossQualificationComponent = this.$refs.crossQualificationState as VueCrossQualificationState;
    }

    public get assessmentAmount() {
        if(!this.assessmentComponent) {
            return 0;
        }
        // @ts-ignore
        return this.assessmentComponent.courseAmounts;
    }

    public get specialisationAmount() {
        if(!this.specialisationComponent) {
            return 0;
        }
        // @ts-ignore
        return this.specialisationComponent.courseAmounts;
    }

    // public get crossQualificationAmount() {
    //     if(!this.crossQualificationComponent) {
    //         return 0;
    //     }
    //     // @ts-ignore
    //     return this.crossQualificationComponent.courseAmounts;
    // }

    public ccOrSpecialisationIsActive() {
        if(this.planning.specialization_year_id) {
            console.log('active specialisation');
            this.specialisationActive = true;
            this.crossQualificationActive = false;
            return;
        }

        if(this.planning.cross_qualification_year_id) {
            this.specialisationActive = false;
            this.crossQualificationActive = true;
            console.log('active cross');
            return;
        }

        else {
            this.specialisationActive = false;
            this.crossQualificationActive = false;
            console.log('active nix');
            return;
        }
    }
}
</script>



