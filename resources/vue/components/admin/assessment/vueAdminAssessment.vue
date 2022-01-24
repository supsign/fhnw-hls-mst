<template>
    <div>
        <vue-admin-assessment-edit :assessment-id="assessmentId"></vue-admin-assessment-edit>

    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../../base/baseComponent";
import VueCard from "../../base/vueCard.vue";
import VueAdminAssessmentEdit from "./vueAdminAssessmentEdit.vue";
import {IStudyFieldYear} from "../../../interfaces/studyFieldYear.interface";

@Component({
    components: {
        VueCard,
        VueAdminAssessmentEdit
    }
})
export default class VueAdminAssessment extends BaseComponent {
    @Prop({type: Number})
    public assessmentId: number

    @Propt({type: Array})
    public studyFieldYears: IStudyFieldYear

}
</script>
