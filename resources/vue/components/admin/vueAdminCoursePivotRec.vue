<template>
    <div v-if="course">
        <div :class="{'text-gray-500': isRemoving}" class="flex flex-row gap-4 items-center">
            <div class="cursor-pointer" @click="remove">
                <i aria-hidden="true" class="far fa-trash"></i>
            </div>
            <div class="w-40 flex-shrink-0">{{ course.number }}</div>
            <div :class="{'text-red-600': notHoldInSemester}">{{ course.name }}</div>

        </div>
    </div>
    <div v-else>

        <div :class="{'text-gray-500': isRemoving}" class="flex flex-row gap-4 items-center">
            <div class="cursor-pointer" @click="remove">
                <i aria-hidden="true" class="far fa-trash"></i>
            </div>
            <div class="w-40 flex-shrink-0"> ----</div>
            <div>Kurs nicht geladen: ID{{ coursePivot.id }} CourseId:
                {{ coursePivot.course_id }}
            </div>

        </div>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";


@Component
export default class VueAdminCoursePivotRec extends BaseComponent {

    @Prop({type: Object})
    public coursePivot: { course_id: number }

    @Prop({type: Boolean})
    public isHs: boolean

    public isRemoving = false;

    public get course() {
        return this.models.course.getById(this.coursePivot.course_id)
    }

    public get notHoldInSemester() {
        return this.isHs && !this.course.is_hs || !this.isHs && !this.course.is_fs
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
