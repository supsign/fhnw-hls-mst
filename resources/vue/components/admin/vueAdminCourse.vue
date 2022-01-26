<template>
    <div v-if="course">
        {{ course.number }} {{ course.name }}
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";

@Component
export default class VueAdminCourse extends BaseComponent {
    @Prop({type: Number})
    public courseId: number

    public get course() {
        return this.models.course.getById(this.courseId)
    }
}
</script>
