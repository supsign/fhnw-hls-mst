<template>
    <div class="w-16 text-center">
        <div v-if="!coursePlanning && !planningIsLocked" class="flex text-center justify-center"
             @click.stop="openPicker">
            <img :src="'/img/calendarIcon.svg'" alt="module_icon"
                 class="w-7 h-7 my-auto">
        </div>
        <div v-else-if="coursePlanningSemester" :class="{'cursor-pointer': !planningIsLocked}" class="text-sm"
             @click.stop="openPicker">
            {{ coursePlanningSemester.year - 2000 }}
            {{ coursePlanningSemester.is_hs ? 'HS' : 'FS' }}
        </div>
        <vue-semester-picker v-if="pickerIsOpen" :course="course" :is-saving="isSaving"
                             :isSaving="isSaving"
                             :selected-semester="coursePlanningSemester"
                             :semesters="semesters"
                             @cancel="cancel"
                             @remove="remove"
                             @select="select"></vue-semester-picker>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ICoursePlanning} from "../../store/coursePlanning/coursePlanning.interface";
import {ISemester} from "../../interfaces/semester.interface";
import VueSemesterPicker from "./vueSemesterPicker.vue";
import {ICourse} from "../../interfaces/course.interface";

@Component({
    components: {
        VueSemesterPicker
    }
})
export default class VuePlanCourse extends BaseComponent {
    @Prop({type: Number})
    public planningId: number

    @Prop({type: Object})
    public course: ICourse

    @Prop({
        type: Array
    })
    public semesters: ISemester[]

    @Prop({type: Boolean, default: false})
    planningIsLocked: boolean

    public pickerIsOpen = false;

    public isSaving = false;

    public get coursePlanning(): ICoursePlanning | null {
        if (!this.planningId) {
            return;
        }
        if (!this.course.id) {
            return;
        }
        return this.models.coursePlanning.getCoursePlanning(this.planningId, this.course.id);
    }

    public get coursePlanningSemester(): ISemester {
        return this.semesters.find((semester) => semester.id === this.coursePlanning?.semester_id);
    }

    public cancel() {
        this.pickerIsOpen = false;
    }

    public async select(semester: ISemester) {
        this.isSaving = true;
        if (this.coursePlanning) {
            await this.patchCourse(semester);
            this.pickerIsOpen = false;
            this.isSaving = false;
            return;
        }

        await this.planCourse(semester)
        this.pickerIsOpen = false;
        this.isSaving = false;

    }

    public async remove() {
        await this.models.coursePlanning.delete(this.coursePlanning.id);
        this.pickerIsOpen = false;
        this.isSaving = false;
    }

    public patchCourse(semester: ISemester) {
        this.models.coursePlanning.patchById(this.coursePlanning.id, {semester_id: semester.id});
        return this.models.coursePlanning.save(this.coursePlanning.id);
    }

    public planCourse(semester: ISemester) {
        return this.models.coursePlanning.post({
            course_id: this.course.id,
            planning_id: this.planningId,
            semester_id: semester.id
        })
    }

    public openPicker() {
        if (this.planningIsLocked) {
            return;
        }
        this.pickerIsOpen = true
    }

}
</script>

