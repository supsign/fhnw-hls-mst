<template>
    <div>
        <div v-for="course in specialisationCourses" class="mb-1 flex flex-row justify-between">
            <div>{{ course.name }}</div>
            <div v-if="coursesIsCompletedSusscessfully(course)" class="my-auto"><i class="far fa-check-circle" aria-hidden="true"></i></div>
            <div class="flex flex-row space-x-1"
                 v-else-if="courseIsPlanned(course)">
                <div>{{ coursePlanningSemester(course) }}</div>
                <div>{{ coursePlanningSemesterHsFs(course) }}</div>
            </div>
            <div v-else class="my-auto"><i class="far fa-circle " aria-hidden="true"></i></div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";

@Component
export default class VueCrossQualificationState extends BaseComponent {

}
</script>
