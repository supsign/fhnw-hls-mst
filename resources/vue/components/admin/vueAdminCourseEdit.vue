<template>
    <div>
        Test
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ICoursePlanning} from "../../store/coursePlanning/coursePlanning.interface";
import {ICourseGroupYear} from "../../interfaces/courseGroupYear.interface";
import {ICourse} from "../../interfaces/course.interface";
import {ICompletion} from "../../interfaces/completion.interface";

@Component
export default class VueAdminCourseEdit extends BaseComponent {

}
</script>
