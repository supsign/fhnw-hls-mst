<template>
    <div v-if="course" class="flex border-t p-1 text-left text-xs lg:text-sm" @click="openModal">
        <div class="w-8">
            <slot name="icon"></slot>
        </div>
        <div class="my-auto break-words flex-grow"
             :class="{ 'cursor-pointer': courseYear.contents }">
            {{ course.name }}
        </div>
        <vue-plan-course
            v-if="!courseIsSuccessfullyCompleted"
            :course="course"
            :planningId="planningId"
            :planningIsLocked="planningIsLocked"
            :semesters="semesters"
            class="flex-none my-auto"
        >
        </vue-plan-course>
        <vue-course-detail-modal
            v-if="courseYear && detailModalIsOpen"
            :course="course"
            :courseIsSuccessfullyCompleted="courseIsSuccessfullyCompleted"
            :courseYear="courseYear"
            :isPlaned="!!coursePlanning"
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
import {ICourseSkill} from "../../interfaces/courseSkill.interface";
import {ICoursePlanning} from "../../store/coursePlanning/coursePlanning.interface";

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
    skills: ISkill[]

    @Prop({type: Boolean, default: false})
    planningIsLocked: boolean

    @Prop({type: Boolean})
    courseIsSuccessfullyCompleted: boolean;
    public detailModalIsOpen = false;

    public get coursePlanning(): ICoursePlanning | null {
        if (!this.planningId) {
            return;
        }
        if (!this.course.id) {
            return;
        }
        return this.models.coursePlanning.getCoursePlanning(this.planningId, this.course.id);
    }

    public get requiredSkills(): ICourseSkill[] {
        if (!this.course) {
            return [];
        }

        return this.course.course_skills.filter(courseSkill => !courseSkill.is_acquisition);
    }

    public get notCompletedSkillIds(): number[] {
        return this.requiredSkills.filter((courseSkill) => {
            return !this.models.skillStudent.all.find(skillStudent => skillStudent.skill_id === courseSkill.skill_id)
        }).map(courseSkill => courseSkill.skill_id)
    }

    public get notPlannedNotCompletedCourseSkillIds(): number[] {
        return this.notCompletedSkillIds.filter(notCompletetedSkillId => {
            return !this.plannedSkillIdsBefore.includes(notCompletetedSkillId)
        })
    }

    public get plannedSkillIdsBefore(): number[] {
        const courseIdsBefore = this.coursePlanningsBefore.map(coursePlanning => coursePlanning.course_id);
        return this.models.courseSkill
            .getByCoursesIds(courseIdsBefore)
            .filter(courseSkill => courseSkill.is_acquisition === true)
            .map(courseSkill => courseSkill.skill_id)
    }

    public get coursePlanningsBefore(): ICoursePlanning[] {
        const semesterOfPlanning = this.models.semester.getById(this.coursePlanning?.semester_id);
        if (!semesterOfPlanning) {
            return []
        }

        return this.models.coursePlanning.all.filter(coursePlanning => {
                const semester = this.models.semester.getById(coursePlanning.semester_id);
                return new Date(semester.start_date).getTime() < new Date(semesterOfPlanning.start_date).getTime();
            }
        );
    }


    public get missingCourses() {
        return this.models.course.getByAcquisitionSkillIds(this.notPlannedNotCompletedCourseSkillIds);
    }

    public get course(): ICourse {
        return this.models.course.getById(this.courseId);
    }

    public get semesters(): ISemester[] {
        return this.models.semester.all
    }

    public closeModal() {
        this.detailModalIsOpen = false;
    }

    public openModal() {
        this.detailModalIsOpen = true;
    }


}
</script>
