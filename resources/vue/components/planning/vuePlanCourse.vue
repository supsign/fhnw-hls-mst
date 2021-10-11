<template>
    <div v-if="!coursePlanning" class="">
        <img class="cursor-pointer w-8 h-8 my-auto" :src="'/img/calendarIcon.svg'" alt="module_icon" >
    </div>
    <div v-else class="text-sm">
        geplant
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ICoursePlanning} from "../../store/coursePlanning/coursePlanning.interface";

@Component
export default class VuePlanCourse extends BaseComponent {
    @Prop({type: Number})
    public planningId:number

    @Prop({type: Number})
    public courseId:number

    public get coursePlanning(): ICoursePlanning|null {
        if (!this.planningId){
            return;
        }
        if(!this.courseId) {
            return;
        }
        return this.models.coursePlanning.getCoursePlanning(this.planningId, this.courseId);
    }

}
</script>

