<template>
    <div class="flex flex-row">
        <div class="w-60">{{ course.number}}</div>
        <div class="flex-grow">{{ course.name}}</div>

        <div v-if="course.is_hs"
             class="w-24"
        >
            <i class="fas fa-check-square text-blue-700"></i>
        </div>
        <div v-else
             class="w-24"
        >
            <i class="far fa-square text-blue-700"></i>
        </div>

        <div v-if="course.is_fs"
             class="w-24"
        >
            <i class="fas fa-check-square text-blue-700"></i>
        </div>
        <div v-else
             class="w-24"
        >
            <i class="far fa-square text-blue-700"></i>
        </div>

    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ICourse} from "../../interfaces/course.interface";
import VueCheckbox from "../form/vueCheckbox.vue";
import axios from "axios";
import {IMentor} from "../../interfaces/mentor.interface";
import {Toast} from "../../helpers/toast";

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

    public changeHs() {
        this.hs = !this.hs;
        // axios.patch(`/webapi/courses/${this.course.id}`, {
        //     is_hs: this.hs
        // });
    }

    public changeFS() {
        this.fs = !this.fs;
        // axios.patch(`/webapi/courses/${this.course.id}`, {
        //     is_fs: this.fs
        // });
    }
}
</script>
