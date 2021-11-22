<template>
    <div>
        <div v-if="!coursePlanning" class="" @click="()=>{pickerIsOpen = true}">
            <img :src="'/img/calendarIcon.svg'" alt="module_icon" class="cursor-pointer w-8 h-8 my-auto">
        </div>
        <div v-else-if="coursePlanningSemester" class="text-sm" @click="()=>{pickerIsOpen = true}">
            {{ coursePlanningSemester.year - 2000 }}
            {{ coursePlanningSemester.is_hs ? 'HS' : 'FS' }}
        </div>
        <vue-semester-picker v-if="pickerIsOpen" :is-saving="isSaving" :isSaving="isSaving"
                             :selected-semester="coursePlanningSemester"
                             :semesters="semesters"
                             @cancel="cancel"
                             @select="select"></vue-semester-picker>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ICoursePlanning} from "../../store/coursePlanning/coursePlanning.interface";
import {ISemester} from "../../interfaces/semester.interface";
import VueSemesterPicker from "./vueSemesterPicker.vue";

@Component({
    components: {
        VueSemesterPicker
    }
})
export default class VuePlanCourse extends BaseComponent {
    @Prop({type: Number})
    public planningId: number

    @Prop({type: Number})
    public courseId: number

    @Prop({
        type: Array
    })
    public semesters: ISemester[]

    public pickerIsOpen = false;

    public isSaving = false;

    public get coursePlanning(): ICoursePlanning | null {
        if (!this.planningId) {
            return;
        }
        if (!this.courseId) {
            return;
        }
        return this.models.coursePlanning.getCoursePlanning(this.planningId, this.courseId);
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

    public patchCourse(semester: ISemester) {
        this.models.coursePlanning.patchById(this.coursePlanning.id, {semester_id: semester.id});
        return this.models.coursePlanning.save(this.coursePlanning.id);
    }

    public planCourse(semester: ISemester) {
        return this.models.coursePlanning.post({
            course_id: this.courseId,
            planning_id: this.planningId,
            semester_id: semester.id
        })
    }

}
</script>

