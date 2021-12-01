<template>
    <div v-if="semesterIsInPlanning"
        class="mb-4">
        <div class="font-bold sm:text-sm lg:text-base">{{ semester.is_hs ? 'HS' : 'FS' }} {{ semester.year}}</div>

        <div v-for="coursePlanning in coursePlanningInSemester"
             class="ml-5 sm:text-sm lg:text-base">
            <div>Kurs-ID: {{ coursePlanning.course_id }} </div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ISemester} from "../../interfaces/semester.interface";
import {ICoursePlanning} from "../../store/coursePlanning/coursePlanning.interface";

@Component
export default class VuePlanningSemester extends BaseComponent {
    @Prop({type: Object})
    public semester: ISemester

    @Prop({type: Object})
    public planning: ICoursePlanning

    public get coursePlannings(): ICoursePlanning[] {
        return this.models.coursePlanning.byPlanningId(this.planning.id);
    }

    public get coursePlanningInSemester() {
        return this.coursePlannings.filter((coursePlanning) => coursePlanning.semester_id === this.semester.id);
    }

    public get semesterIsInPlanning() {
        return this.coursePlanningInSemester.find(coursePlanning => coursePlanning.semester_id === this.semester.id);
    }

}
</script>

