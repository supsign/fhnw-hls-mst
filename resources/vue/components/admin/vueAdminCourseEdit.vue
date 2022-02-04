<template>
    <div class="flex flex-row text-sm lg:text-base space-x-2">
        <div class="w-40 lg:w-60" :class="{'line-through': !hs && !fs}">{{ course.number }}</div>
        <div class="flex-grow" :class="{'line-through': !hs && !fs}">{{ course.name }}</div>

        <div v-if="hs"
             class="w-8 lg:w-16"
             @click="changeHs"
        >
            <i class="fas fa-check-square text-blue-700 cursor-pointer" aria-hidden="true"></i>
        </div>
        <div v-else
             class="w-8 lg:w-16"
             @click="changeHs"
        >
            <i class="far fa-square text-blue-700 cursor-pointer" aria-hidden="true"></i>
        </div>

        <div v-if="fs"
             class="w-8 lg:w-16"
             @click="changeFS"
        >
            <i class="fas fa-check-square text-blue-700 cursor-pointer" aria-hidden="true"></i>
        </div>
        <div v-else
             class="w-8 lg:w-16"
             @click="changeFS"
        >
            <i class="far fa-square text-blue-700 cursor-pointer" aria-hidden="true"></i>
        </div>

    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ICourse} from "../../interfaces/course.interface";
import VueCheckbox from "../form/vueCheckbox.vue";
import axios from "axios";

@Component({
    components: {
        VueCheckbox
    }
})
export default class VueAdminCourseEdit extends BaseComponent {
    @Prop({type: Object})
    public course: ICourse

    public hs = false;
    public fs = false;

    public created() {
        this.hs = this.course.is_hs;
        this.fs = this.course.is_fs;
    }

    public changeHs() {
        this.hs = !this.hs;
        axios.patch<ICourse>(`/webapi/courses/${this.course.id}`, {
            is_hs: this.hs
        });
    }

    public changeFS() {
        this.fs = !this.fs;
        axios.patch<ICourse>(`/webapi/courses/${this.course.id}`, {
            is_fs: this.fs
        });
    }
}
</script>
