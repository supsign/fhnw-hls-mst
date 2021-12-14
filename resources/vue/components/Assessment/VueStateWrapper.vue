<template>
    <div class="rounded border shadow-md fixed bottom-0 left-0 mt-2 w-full bg-hls-200"
         v-if="!!assessment">
        <div class="border-b text-sm lg:text-base p-3 bg-hls transition duration-200 ease-in-out overflow-y-scroll max-h-56 lg:overflow-y-auto lg:max-h-full"
             :class=" { hidden: !showAssessment || showSpecialization || showCrossQualification }"
             >
            <vue-assessment-state :assessment="assessment"
                                  :assessment-courses="assessmentCourses"
                                  :completions="completions"
                                  :planning-id="planningId"
                                  :semesters="semesters"
                                  ref="assessmentState"
            ></vue-assessment-state>
        </div>
        <div v-if="!!specialization"
             class="border-b text-sm lg:text-base p-3 bg-hls transition duration-200 ease-in-out overflow-y-scroll max-h-56 lg:overflow-y-auto lg:max-h-full"
             :class=" { hidden: !showSpecialization || showAssessment || showCrossQualification }"
        >
            <vue-specialization-state :specialization="specialization"
                                      :specialization-year="specializationYear"
                                      :specialization-courses="specializationCourses"
                                      :completions="completions"
                                      :planning-id="planningId"
                                      :semesters="semesters"
                                      :planning="planning"
                                      ref="specializationState"
            ></vue-specialization-state>
        </div>
        <div v-if="!!crossQualification"
             class="border-b text-sm lg:text-base p-3 bg-hls transition duration-200 ease-in-out overflow-y-scroll max-h-56 lg:overflow-y-auto lg:max-h-full"
             :class=" { hidden: !showCrossQualification || showAssessment || showSpecialization }"
        >
            <vue-cross-qualification-state :cross-qualification="crossQualification"
                                           :cross-qualification-year="crossQualificationYear"
                                           :cross-qualification-courses="crossQualificationCourses"
                                           :completions="completions"
                                           :planning-id="planningId"
                                           :semesters="semesters"
                                           :planning="planning"
                                           ref="crossQualificationState"
            ></vue-cross-qualification-state>
        </div>
        <div class="md:w-full mx-auto grid grid-cols-3 lg:h-16">
            <div class="text-center border-l border-hls text-sm my-auto h-full lg:flex lg:justify-center lg:items-center lg:space-x-2" @click="toggleShowCrossQualification">
                <div>{{ countCredits }}&nbsp;|&nbsp;180</div>
                <div>ECTS</div>
            </div>
            <div v-if="!specialization && !crossQualification"></div>
            <div v-if="!!crossQualification"
                 class="text-center border-l border-hls text-sm hover:bg-hls hover:border-gray-200 my-auto cursor-pointer lg:h-full lg:flex lg:justify-center lg:items-center lg:space-x-2" @click="toggleShowCrossQualification">
                <div>{{ crossQualificationAmount }}&nbsp;|&nbsp;{{ crossQualificationYear.amount_to_pass }}</div>
                <div>CrossQual.</div>
            </div>
            <div v-if="!!specialization"
                 class="text-center border-l border-hls text-sm hover:bg-hls hover:border-gray-200 my-auto cursor-pointer lg:h-full lg:flex lg:justify-center lg:items-center lg:space-x-2" @click="toggleShowSpecialization">
                <div>{{ specializationAmount }}&nbsp;|&nbsp;{{ specializationYear.amount_to_pass }}</div>
                <div>Specialization</div>
            </div>
            <div class="text-center border-l border-hls text-sm hover:bg-hls hover:border-gray-200 my-auto cursor-pointer lg:h-full lg:flex lg:justify-center lg:items-center lg:space-x-2" @click="toggleShowAssessment">
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
    public specialization: ISpecialization

    @Prop({type: Object})
    public specializationYear?: ISpecializationYear

    @Prop({type: Array})
    public specializationCourses: ICourse[]

    @Prop({type: Object})
    public crossQualification: ICrossQualification

    @Prop({type: Object})
    public crossQualificationYear?: ICrossQualificationYear

    @Prop({type: Array})
    public crossQualificationCourses: ICourse[]

    @Prop({type: Array})
    public courses: ICourse[];

    public showAssessment = false;

    public showSpecialization = false;

    public showCrossQualification = false;

    public assessmentComponent: VueAssessmentState = null;

    public specializationComponent: VueSpecializationState = null;

    public crossQualificationComponent: VueCrossQualificationState = null;

    public toggleShowAssessment() {
        if(this.showSpecialization) {
            this.showSpecialization = !this.showSpecialization;
        }
        if(this.showCrossQualification) {
            this.showCrossQualification = !this.showCrossQualification;
        }
        this.showAssessment = !this.showAssessment;
    }

    public toggleShowSpecialization() {
        if(this.showAssessment) {
            this.showAssessment = !this.showAssessment;
        }
        this.showSpecialization = !this.showSpecialization;
    }

    public toggleShowCrossQualification() {
        if(this.showAssessment) {
            this.showAssessment = !this.showAssessment;
        }
        this.showCrossQualification = !this.showCrossQualification;
    }

    public mounted() {
        this.assessmentComponent = this.$refs.assessmentState as VueAssessmentState;
        this.specializationComponent = this.$refs.specializationState as VueSpecializationState;
        this.crossQualificationComponent = this.$refs.crossQualificationState as VueCrossQualificationState;
    }

    public get assessmentAmount() {
        if(!this.assessmentComponent) {
            return 0;
        }
        // @ts-ignore
        return this.assessmentComponent.courseAmounts;
    }

    public get specializationAmount() {
        if(!this.specializationComponent) {
            return 0;
        }
        // @ts-ignore
        return this.specializationComponent.courseAmounts;
    }

    public get crossQualificationAmount() {
        if(!this.crossQualificationComponent) {
            return 0;
        }
        // @ts-ignore
        return this.crossQualificationComponent.courseAmounts;
    }

    public get countCredits(): number {
        let credits = 0;

        for (const course of this.courses) {
            if (this.coursesIsCompletedSusscessfully(course)) {
                credits += course.credits;
                continue;
            }

            if (this.courseIsPlanned(course)) {
                credits += course.credits;
            }
        }

        return credits;
    }

    public coursesIsCompletedSusscessfully(course: ICourse): boolean {
        return !!this.completions.find((completion) => {
            return completion.course_id === course.id && (completion.completion_type_id === 2 || completion.completion_type_id === 4)
        })
    }

    public courseIsPlanned(course: ICourse): boolean {
        return !!this.coursePlannings.find(coursePlanning => coursePlanning.course_id === course.id)
    }

    public get coursePlannings(): ICoursePlanning[] {
        return this.models.coursePlanning.all.filter((coursePlanning) => {
            return !!this.courses.find(course => course.id === coursePlanning.course_id)
        });
    }
}
</script>



