<template>
    <div v-if="course">
        <div class="flex flex-row gap-4 items-center" :class="{'text-gray-500': isRemoving}">
            <div class="cursor-pointer" @click="remove">
                <i class="far fa-trash" aria-hidden></i>
            </div>
            <div class="w-40 flex-shrink-0">{{ course.number }}</div>
            <div>{{ course.name }}</div>

        </div>
    </div>
    <div v-else>Kurs nicht geladen: ID{{ courseCrossQualificationYear.id }} CourseId:
        {{ courseCrossQualificationYear.course_id }}
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";


@Component
export default class VueAdminCoursePivot extends BaseComponent {

    @Prop({type: Object})
    public coursePivot: { course_id: number }

    public isRemoving = false;

    public get course() {
        return this.models.course.getById(this.coursePivot.course_id)
    }

    public remove() {
        if (this.isRemoving) {
            return;
        }
        this.isRemoving = true;
        this.$emit('remove', this.coursePivot);
    }
}
</script>
