<template>
    <div class="fixed bottom-0 left-0 mt-2 w-full lg:px-8">
        <div v-if="showAssessment || showSpecCross" class="grid grid-cols-1 md:grid-cols-3">
            <div></div>
            <div class="text-sm lg:text-base overflow-y-auto max-h-full">
                <vue-courses-tab
                    v-if="(specialization || crossQualification) && showSpecCross"
                    :completions="completions"
                    :courses="specializationCourses || crossQualificationCourses"
                    :planning-id="planningId"
                    :semesters="semesters"
                    class="bg-hls rounded-t-lg p-3"
                />
            </div>
            <div class="text-sm lg:text-base overflow-y-auto max-h-full">
                <vue-courses-tab
                    v-if="showAssessment"
                    :completions="completions"
                    :courses="assessmentCourses"
                    :planning-id="planningId"
                    :semesters="semesters"
                    class="bg-hls rounded-t-lg p-3"
                />
            </div>
        </div>

        <div class="grid grid-cols-3 md:w-full bg-hls-200">
            <div class="text-center">
                <div>{{ countCredits }}&nbsp;|&nbsp;180</div>
                <div>ECTS</div>
            </div>
            <div
                :class="{
                    'bg-hls': showSpecCross,
                    'hover:bg-hls cursor-pointer': crossQualification || specialization,
                }"
                class="text-center"
                @click="toggleShowSpecCross"
            >
                <vue-courses-state
                    v-if="!!crossQualification"
                    :amount-to-pass="crossQualificationYear.amount_to_pass"
                    :completions="completions"
                    :courses="crossQualificationCourses"
                    :planning-id="planningId"
                    name="Querschnittqual."
                />
                <vue-courses-state
                    v-if="!!specialization"
                    :amount-to-pass="specializationYear.amount_to_pass"
                    :completions="completions"
                    :courses="specializationCourses"
                    :planning-id="planningId"
                    name="Spezialisierung"
                />
            </div>
            <div
                v-if="!!assessment"
                :class="{ 'bg-hls': showAssessment }"
                class="hover:bg-hls cursor-pointer"
                @click="toggleShowAssessment"
            >
                <vue-courses-state
                    :amount-to-pass="assessment.amount_to_pass"
                    :completions="completions"
                    :courses="assessmentCourses"
                    :planning-id="planningId"
                    name="Assessment"
                />
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { Component, Prop } from 'vue-property-decorator';
import BaseComponent from '../base/baseComponent';
import VueCoursesTab from './VueCoursesTab.vue';
import { IAssessment } from '../../interfaces/assessment.interface';
import { ICourse } from '../../interfaces/course.interface';
import { ICompletion } from '../../interfaces/completion.interface';
import { ISemester } from '../../interfaces/semester.interface';
import { ISpecialization } from '../../interfaces/specialization.interface';
import { ISpecializationYear } from '../../interfaces/specialzationYear.interface';
import { ICoursePlanning } from '../../store/coursePlanning/coursePlanning.interface';
import { ICrossQualification } from '../../interfaces/crossQualification.interface';
import { ICrossQualificationYear } from '../../interfaces/crossQualificationYear.interface';
import VueCoursesState from './VueCoursesState.vue';

@Component({
    components: {
        VueCoursesTab,
        VueCoursesState,
    },
})
export default class VueStateWrapper extends BaseComponent {
    @Prop({ type: Number })
    public planningId: number;

    @Prop({ type: Object })
    public assessment: IAssessment;

    @Prop({ type: Array })
    public assessmentCourses: ICourse[];

    @Prop({ type: Array })
    public completions: ICompletion[];

    @Prop({ type: Array })
    public semesters: ISemester[];

    @Prop({ type: Object })
    public specialization: ISpecialization;

    @Prop({ type: Object })
    public specializationYear?: ISpecializationYear;

    @Prop({ type: Array })
    public specializationCourses: ICourse[];

    @Prop({ type: Object })
    public crossQualification: ICrossQualification;

    @Prop({ type: Object })
    public crossQualificationYear?: ICrossQualificationYear;

    @Prop({ type: Array })
    public crossQualificationCourses: ICourse[];

    @Prop({ type: Array })
    public courses: ICourse[];

    public showAssessment = false;

    public showSpecCross = false;

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

    public get coursePlannings(): ICoursePlanning[] {
        return this.models.coursePlanning.all.filter((coursePlanning) => {
            return !!this.courses.find((course) => course.id === coursePlanning.course_id);
        });
    }

    public toggleShowAssessment() {
        console.log('toggleShowAssessment');
        this.showSpecCross = false;
        this.showAssessment = !this.showAssessment;
    }

    public toggleShowSpecCross() {
        if (!this.crossQualification && !this.specialization) {
            return;
        }
        this.showAssessment = false;
        this.showSpecCross = !this.showSpecCross;
    }

    public coursesIsCompletedSusscessfully(course: ICourse): boolean {
        return !!this.completions.find((completion) => {
            return (
                completion.course_id === course.id &&
                (completion.completion_type_id === 2 || completion.completion_type_id === 4)
            );
        });
    }

    public courseIsPlanned(course: ICourse): boolean {
        return !!this.coursePlannings.find((coursePlanning) => coursePlanning.course_id === course.id);
    }
}
</script>
