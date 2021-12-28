<template>
    <vue-input v-model="assessment" label="Assessment"/>
</template>

<script lang="ts">
import {Component, Prop, Watch} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import VueCard from "../base/vueCard.vue";
import VueInput from "../form/vueInput.vue";
import {IAssessment} from "../../interfaces/assessment.interface";

@Component({
    components: {
        VueCard,
        VueInput
    }
})
export default class VueAdminSpezAssesment extends BaseComponent {
    @Prop({type: Number})
    assessmentId: number

    @Prop({type: Array})
    assessments: IAssessment[]

    assessment: IAssessment = null

    public created() {
        this.assessment = this.assessments.find(ass => ass.id === this.assessmentId);
    }

    @Watch('assessmentId')
    public setAssessment(id: number) {
        this.assessment = this.assessments.find(ass => ass.id === id);
    }


}
</script>
