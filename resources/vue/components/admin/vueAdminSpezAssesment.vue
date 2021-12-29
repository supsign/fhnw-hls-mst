<template>
    <vue-select v-model="assessment" :options="assessments" label="Assessment"/>
</template>

<script lang="ts">
import {Component, Prop, Watch} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import VueCard from "../base/vueCard.vue";
import {IAssessment} from "../../interfaces/assessment.interface";
import VueSelect from "../form/vueSelect.vue";

@Component({
    components: {
        VueCard,
        VueSelect
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
