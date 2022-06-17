<template>
    <div class="space-y-1">
        <div v-for="course in courses" class="mb-1 flex flex-row">
            <div class="w-16 text-center flex-grow-0 flex-shrink-0 my-auto">
                <div v-if="coursesIsCompletedSusscessfully(course)">
                    <i aria-hidden="true" class="far fa-check-circle"></i>
                </div>
                <div v-else-if="courseIsPlanned(course)" class="flex flex-row space-x-1 justify-center font-bold">
                    <div>{{ coursePlanningSemester(course) }}</div>
                    <div>{{ coursePlanningSemesterHsFs(course) }}</div>
                </div>
                <div v-else><i aria-hidden="true" class="far fa-circle"></i></div>
            </div>

            <div class="flex-grow flex-shrink">{{ course.name }}</div>
        </div>
    </div>
</template>

<script lang="ts">
import { Component, Prop } from 'vue-property-decorator';
import BaseComponent from '../base/baseComponent';
import { ICompletion } from '../../interfaces/completion.interface';
import { ICourse } from '../../interfaces/course.interface';
import { ICoursePlanning } from '../../store/coursePlanning/coursePlanning.interface';
import { ISemester } from '../../interfaces/semester.interface';

@Component
export default class VueCoursesTab extends BaseComponent {
    @Prop({ type: Number })
    public planningId: number;

    @Prop({ type: Array })
    public courses: ICourse[];

    @Prop({ type: Array })
    public completions: ICompletion[];

    @Prop({ type: Array })
    public semesters: ISemester[];

    public get coursePlannings(): ICoursePlanning[] {
        return this.models.coursePlanning.byPlanningId(this.planningId);
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

    public coursePlanningSemester(course: ICourse) {
        const semesterId = this.coursePlannings.find((semesterId) => semesterId.course_id === course.id).semester_id;
        return this.semesters.find((semester) => semester.id === semesterId).year - 2000;
    }

    public coursePlanningSemesterHsFs(course: ICourse) {
        const semesterId = this.coursePlannings.find((semesterId) => semesterId.course_id === course.id).semester_id;
        return this.semesters.find((semester) => semester.id === semesterId).is_hs ? 'HS' : 'FS';
    }
}
</script>
