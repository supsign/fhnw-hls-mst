<template>
    <div class="">


    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {IStudyField} from "../../interfaces/studyField.interface";

@Component
export default class VueAdminMentorStudyFields extends BaseComponent {
    @Prop({type: Array})
    public studyFields: IStudyField[]

    @Prop({type: Array})
    public mentorStudyFields: IMentorStudyField[]

}
</script>
