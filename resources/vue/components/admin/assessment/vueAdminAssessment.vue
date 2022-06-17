<template>
    <div class="space-y-4">
        <vue-admin-assessment-edit :assessment-id="assessmentId"></vue-admin-assessment-edit>
        <div class="text-xl text-gray-600">Kontrolle der Studienrichtungen</div>
        <vue-admin-assessment-study-field-check
            v-for="studyFieldYear in studyFieldYears"
            :key="studyFieldYear.id"
            :assessment-id="assessmentId"
            :study-field-year-id="studyFieldYear.id"
        ></vue-admin-assessment-study-field-check>
    </div>
</template>

<script lang="ts">
import { Component, Prop } from 'vue-property-decorator';
import BaseComponent from '../../base/baseComponent';
import VueCard from '../../base/vueCard.vue';
import VueAdminAssessmentEdit from './vueAdminAssessmentEdit.vue';
import { IStudyFieldYear } from '../../../interfaces/studyFieldYear.interface';
import VueAdminAssessmentStudyFieldCheck from './vueAdminAssessmentStudyFieldCheck.vue';

@Component({
    components: {
        VueAdminAssessmentStudyFieldCheck,
        VueCard,
        VueAdminAssessmentEdit,
    },
})
export default class VueAdminAssessment extends BaseComponent {
    @Prop({ type: Number })
    public assessmentId: number;

    @Prop({ type: Array })
    public studyFieldYears: IStudyFieldYear[];
}
</script>
