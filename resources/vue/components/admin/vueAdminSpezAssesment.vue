<template>
    <vue-select v-model="assessment" :options="assessments" label="Assessment" option-key="name"/>
</template>

<script lang="ts">
import {Component, Prop, Watch} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import VueCard from "../base/vueCard.vue";
import {IAssessment} from "../../interfaces/assessment.interface";
import VueSelect from "../form/vueSelect.vue";
import {ISpecializationYear} from "../../interfaces/specialzationYear.interface";

@Component({
    components: {
        VueCard,
        VueSelect
    }
})
export default class VueAdminSpezAssesment extends BaseComponent {
    @Prop({type: Object})
    specializationYear: ISpecializationYear

    assessment: IAssessment = null

    public get assessments() {
        return this.models.assessment.all;
    }

    public created() {
        this.assessment = this.models.assessment.getById(this.specializationYear.assessment_id);
    }

    @Watch('specializationYear')
    public setAssessment(specializationYear: ISpecializationYear) {
        this.assessment = this.models.assessment.getById(specializationYear.assessment_id);
    }


}
</script>
