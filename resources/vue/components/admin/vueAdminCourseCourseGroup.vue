<template>
    <div class="flex flex-row gap-2" :class="{'text-gray-500': isRemoving}">
        <div class="cursor-pointer" @click="remove">
            <i class="far fa-trash" aria-hidden></i>
        </div>
        <div class="w-48">{{course.number}}</div>
        <div>{{course.name}}</div>

    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ICourseCourseGroupYear} from "../../store/courseCourseGroupYear/courseCourseGroupYear.interface";


@Component
export default class VueAdminCourseCourseGroups extends BaseComponent {

    @Prop({type: Object})
    public courseCourseGroupYear: ICourseCourseGroupYear

    public isRemoving = false;

    public get course() {
        return this.models.course.getById(this.courseCourseGroupYear.course_id)
    }

    public remove(){
        if (this.isRemoving){
            return;
        }
        this.isRemoving = true;
        this.$emit('remove', this.courseCourseGroupYear);
    }
}
</script>
