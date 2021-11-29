<template>
    <div class="flex border-t p-1 text-left text-xs lg:text-sm" @click="openModal">
        <div class="w-8">
            <slot name="icon"></slot>
        </div>
        <div class="my-auto break-words flex-grow">
            {{ course.name }}
        </div>
        <vue-plan-course
            v-if="!courseIsSuccessfullyCompleted"
            :course="course"
            :planningId="planningId"
            :semesters="semesters"
            class="flex-none my-auto"
        >
        </vue-plan-course>
        <vue-course-detail-modal
            v-if="courseYear && detailModalIsOpen"
            :course="course"
            :courseYear="courseYear"
            :missingCourses="missingCourses"
            @cancel.stop="closeModal"
        ></vue-course-detail-modal>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ICourse} from "../../interfaces/course.interface";
import {ISemester} from "../../interfaces/semester.interface";
import VuePlanCourse from "./vuePlanCourse.vue";
import VueCourseDetailModal from "./vueCourseDetailModal.vue";
import {ISkill} from "../../interfaces/skill.interface";

@Component({
    components: {
        VueCourseDetailModal,
        VuePlanCourse
    }
})
export default class VueCourseDetail extends BaseComponent {

    @Prop({type: Number})
    courseId: number

    @Prop({type: Object})
    courseYear: ICourse

    @Prop({type: Number})
    planningId: number

    @Prop({type: Array})
    requiredSkills: ISkill[]

    @Prop({type: Array})
    skills: ISkill[]

    @Prop({type: Boolean})
    courseIsSuccessfullyCompleted: boolean;
    public detailModalIsOpen = false;

    public get course(): ICourse {
        return this.models.course.getById(this.courseId);
    }

    public get semesters(): ISemester[] {
        return this.models.semester.all
    }

    public get notAcquiredSkills() {
        return this.requiredSkills.filter((reqSkill) => !this.skills.find(skill => skill.id === reqSkill.id))
    }

    public get skillsToBePlaned() {
        return this.notAcquiredSkills.filter((skillToBePlanned) => !this.models.coursePlanning.all.map(coursePlanning => coursePlanning.planned_skills).reduce((acc, curVal) => {
            return acc.concat(curVal)
        }, []).find(plannedSkill => plannedSkill.id === skillToBePlanned.id))
    }

    public get missingCoursesNN(): ICourse[] {
        return this.skillsToBePlaned.map((skill) => skill.gain_course).filter((course) => !!course);
    }

    public get missingCourses(): ICourse[] {
        return [...new Set(this.missingCoursesNN.map(course => course.id))].map(courseId => this.missingCoursesNN.find(course => course.id === courseId));
    }

    public closeModal() {
        this.detailModalIsOpen = false;
    }

    public openModal() {
        this.detailModalIsOpen = true;
    }


}
</script>
