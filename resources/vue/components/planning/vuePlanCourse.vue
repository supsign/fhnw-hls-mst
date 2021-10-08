<template>
    <div class="">
        <img class="cursor-pointer w-8 h-8 my-auto" :src="'/img/calendarIcon.svg'" alt="module_icon" >
    </div>
</template>

<script lang="ts">
import {Component} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";

@Component
export default class VuePlanCourse extends BaseComponent {
}
</script>

