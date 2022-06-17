<template>
    <div v-if="allCoursePlanningsInSemesterNotSuccessfullyCompleted.length">
        <vue-plan-wrapper>
            <template v-slot:header>
                <div class="flex justify-between w-full">
                    <div class="sm:text-sm lg:text-base flex-grow">
                        {{ semester.is_hs ? 'HS' : 'FS' }} {{ semester.year }}
                    </div>
                    <div class="border-l py-1 px-2 text-center mx-auto w-16 h-full">
                        {{ getAllPointsInSemester(semester) }}
                    </div>
                </div>
            </template>
            <vue-course-detail
                v-for="coursePlanning in allCoursePlanningsInSemesterNotSuccessfullyCompleted"
                :key="coursePlanning.id"
                :courseId="coursePlanning.course_id"
                :planning-id="planning.id"
                :planningIsLocked="planningIsLocked"
                :course-is-recommended="getCourseIsRecommended(coursePlanning.course_id)"
                :course-is-spec-cross="
                    getCourseIsSpecialization(coursePlanning.course_id) ||
                    getCourseIsCrossQualification(coursePlanning.course_id)
                "
            >
                <template v-slot:icon>
                    <vue-completion :icon="completion(getCourse(coursePlanning))"> </vue-completion>
                </template>
            </vue-course-detail>
        </vue-plan-wrapper>
    </div>
</template>

<script lang="ts">
import { Component, Prop } from 'vue-property-decorator';
import BaseComponent from '../base/baseComponent';
import VueCourseDetail from './vueCourseDetail.vue';
import { ISemester } from '../../interfaces/semester.interface';
import { ICoursePlanning } from '../../store/coursePlanning/coursePlanning.interface';
import { ICompletion } from '../../interfaces/completion.interface';
import { ICourse } from '../../interfaces/course.interface';
import VueCompletion from './vueCompletion.vue';
import { IPlanning } from '../../interfaces/planning.interface';
import VuePlanWrapper from './vuePlanWrapper.vue';

@Component({
    components: {
        VuePlanWrapper,
        VueCompletion,
        VueCourseDetail,
    },
})
export default class VuePlanningSemester extends BaseComponent {
    @Prop({ type: Object })
    public semester: ISemester;

    @Prop({ type: Object })
    public planning: IPlanning;

    @Prop({ type: Array })
    public completions: ICompletion[];

    @Prop({ type: Boolean, default: false })
    planningIsLocked: boolean;

    public icon = 0;

    public course: ICourse;

    public get coursePlannings(): ICoursePlanning[] {
        return this.models.coursePlanning.byPlanningId(this.planning.id);
    }

    public get coursePlanningsInStudyField() {
        return this.coursePlannings.filter((coursePlanning) => this.getCourse(coursePlanning));
    }

    public get allCoursePlanningsInSemester(): ICoursePlanning[] {
        return this.coursePlanningsInStudyField.filter(
            (coursePlanning) => coursePlanning.semester_id === this.semester.id
        );
    }

    public get allCoursePlanningsInSemesterNotSuccessfullyCompleted() {
        return this.allCoursePlanningsInSemester.filter((coursePlanning) => {
            return !this.coursesIsCompletedSuccessfully(this.getCourse(coursePlanning));
        });
    }

    public get currentYear() {
        return new Date().getFullYear();
    }

    public coursesIsCompletedSuccessfully(course: ICourse): boolean {
        return !!this.completions.find((completion) => {
            return (
                completion.course_id === course.id &&
                (completion.completion_type_id === 2 || completion.completion_type_id === 4)
            );
        });
    }

    public getCourse(coursePlanning: ICoursePlanning): ICourse {
        return this.models.course.getById(coursePlanning.course_id);
    }

    public getAllPointsInSemester(semester: ISemester) {
        let credits = 0;

        for (const coursePlanning of this.coursePlanningsInStudyField) {
            if (coursePlanning.semester_id === semester.id) {
                const course = this.getCourse(coursePlanning);
                credits += course.credits;
            }
        }
        return credits;
    }

    public completion(course: ICourse) {
        let icon: number;

        if (
            !!this.completions.find((completion) => {
                return completion.course_id === course.id && completion.completion_type_id === 3;
            })
        ) {
            icon = 2;
        } else {
            icon = 3;
        }

        return icon;
    }

    public getCourseIsRecommended(courseId: number): boolean {
        if (!this.planning || !this.planning.course_recommendations) {
            return false;
        }
        const courseRecommendation = this.planning.course_recommendations.find((courseRecommendation) => {
            return courseRecommendation.course_id === courseId;
        });
        return !!courseRecommendation;
    }

    public getCourseIsSpecialization(courseId: number): boolean {
        if (!this.planning || !this.planning.course_specialization_years) {
            return false;
        }
        const courseSpecialization = this.planning.course_specialization_years.find((courseSpecialization) => {
            return courseSpecialization.course_id === courseId;
        });
        return !!courseSpecialization;
    }

    public getCourseIsCrossQualification(courseId: number): boolean {
        if (!this.planning || !this.planning.course_cross_qualification_years) {
            return false;
        }
        const courseCrossQualificationYear = this.planning.course_cross_qualification_years.find(
            (courseCrossQualificationYear) => {
                return courseCrossQualificationYear.course_id === courseId;
            }
        );
        return !!courseCrossQualificationYear;
    }
}
</script>
