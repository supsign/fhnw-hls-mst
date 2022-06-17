<template>
    <div class="mb-2 space-y-4">
        <div class="text-xl text-gray-600">Querschnittqualifikationen</div>

        <div class="grid grid-cols-2 gap-4">
            <vue-admin-cross-qualification-year
                v-for="crossQualificationYear in crossQualificationYears"
                :key="crossQualificationYear.id"
                :cross-qualification-year="crossQualificationYear"
            >
            </vue-admin-cross-qualification-year>
        </div>
    </div>
</template>

<script lang="ts">
import { Component, Prop } from 'vue-property-decorator';
import BaseComponent from '../../base/baseComponent';
import VueCard from '../../base/vueCard.vue';
import VueInput from '../../form/vueInput.vue';
import { IStudyFieldYear } from '../../../interfaces/studyFieldYear.interface';
import VueAdminCrossQualificationYear from './vueAdminCrossQualificationYear.vue';
import { ICrossQualificationYear } from '../../../interfaces/crossQualificationYear.interface';

@Component({
    components: {
        VueAdminCrossQualificationYear,
        VueCard,
        VueInput,
    },
})
export default class VueAdminSpecializationYears extends BaseComponent {
    @Prop({ type: Object })
    studyFieldYear: IStudyFieldYear;

    public get crossQualificationYears(): ICrossQualificationYear[] {
        return this.models.crossQualificationYear.filter((spec) => {
            return spec.study_field_year_id === this.studyFieldYear.id;
        });
    }
}
</script>
