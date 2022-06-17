<template>
    <div class="space-y-4">
        <vue-admin-recommendation-edit :recommendation-id="recommendationId"></vue-admin-recommendation-edit>
        <div class="text-xl text-gray-600">Kontrolle der Studienrichtungen</div>
        <vue-admin-recommendation-study-field-check
            v-for="studyFieldYear in studyFieldYears"
            :key="studyFieldYear.id"
            :recommendation-id="recommendationId"
            :study-field-year-id="studyFieldYear.id"
        ></vue-admin-recommendation-study-field-check>
    </div>
</template>

<script lang="ts">
import { Component, Prop } from 'vue-property-decorator';
import BaseComponent from '../../base/baseComponent';
import VueCard from '../../base/vueCard.vue';
import VueAdminCourseRecommendations from './vueAdminCourseRecommendations.vue';
import VueStoreInput from '../../form/storeInput.vue';
import { IStudyFieldYear } from '../../../interfaces/studyFieldYear.interface';
import VueAdminRecommendationEdit from './vueAdminRecommendationEdit.vue';
import VueAdminRecommendationStudyFieldCheck from './vueAdminRecommendationStudyFieldCheck.vue';

@Component({
    components: {
        VueAdminRecommendationStudyFieldCheck,
        VueAdminRecommendationEdit,
        VueAdminCourseRecommendations,
        VueCard,
        VueStoreInput,
    },
})
export default class VueAdminRecommendation extends BaseComponent {
    @Prop({ type: Number })
    public recommendationId: number;

    @Prop({ type: Array })
    public studyFieldYears: IStudyFieldYear[];
}
</script>
