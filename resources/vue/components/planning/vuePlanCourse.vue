<template>
    <div>
        <div v-if="!coursePlanning" class="" @click="()=>{pickerIsOpen = true}">
            <img :src="'/img/calendarIcon.svg'" alt="module_icon" class="cursor-pointer w-8 h-8 my-auto">
        </div>
        <div v-else class="text-sm">
            geplant
        </div>
        <vue-semester-picker v-if="pickerIsOpen" :semesters="semesters" @cancel="cancel"
                             @select="select"></vue-semester-picker>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ICoursePlanning} from "../../store/coursePlanning/coursePlanning.interface";
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
    public semesters: any[]

    public pickerIsOpen = false;

    public get coursePlanning(): ICoursePlanning | null {
        if (!this.planningId) {
            return;
        }
        if (!this.courseId) {
            return;
        }
        return this.models.coursePlanning.getCoursePlanning(this.planningId, this.courseId);
    }

    public cancel() {
        this.pickerIsOpen = false;
    }

    public select(semester: any) {
        this.models.coursePlanning.post({
            course_id: this.courseId,
            planning_id: this.planningId,
            semester_id: semester.id
        })
    }

}
</script>

