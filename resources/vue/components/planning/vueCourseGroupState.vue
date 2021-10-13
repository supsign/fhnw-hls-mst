<template>
    <div class="w-auto">
        <div class="border p-2 md:w-full p-2 mx-auto">{{ countCredits }}&nbsp;/&nbsp;{{ courseGroupYear.credits_to_pass }}</div>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ICoursePlanning} from "../../store/coursePlanning/coursePlanning.interface";
import {ICourseGroupYear} from "../../interfaces/courseGroupYear.interface";
import {ICourse} from "../../interfaces/course.interface";
import {ICompletion} from "../../interfaces/completion.interface";

@Component
export default class VueCourseGroupState extends BaseComponent {
    @Prop({type: Object})
    public courseGroupYear: ICourseGroupYear

    @Prop({type: Array})
    public completions: ICompletion[]

    @Prop({type: Array})
    public courses: ICourse[]

    public get coursePlannings(): ICoursePlanning[] {
        return this.models.coursePlanning.all.filter((coursePlanning) => {
            return !!this.courses.find(course => course.id === coursePlanning.course_id)
        });
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

}
</script>
