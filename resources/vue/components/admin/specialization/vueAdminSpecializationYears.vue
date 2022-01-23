<template>
    <div class="mb-2">

        Spezialisierungen

        <div class="grid grid-cols-2 gap-4">
            <vue-admin-specialization-year
                v-for="specializationYear in specializationYears"
                :key="specializationYear.id"
                :specialization-year="specializationYear"
            >
            </vue-admin-specialization-year>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../../base/baseComponent";
import VueCard from "../../base/vueCard.vue";
import VueInput from "../../form/vueInput.vue";
import {IStudyFieldYear} from "../../../interfaces/studyFieldYear.interface";
import VueAdminSpecializationYear from "./vueAdminSpecializationYear.vue";
import {ISpecializationYear} from "../../../interfaces/specialzationYear.interface";

@Component({
    components: {
        VueAdminSpecializationYear,
        VueCard,
        VueInput
    }
})
export default class VueAdminSpecializationYears extends BaseComponent {

    @Prop({type: Object})
    studyFieldYear: IStudyFieldYear

    public get specializationYears(): ISpecializationYear[] {
        return this.models.specializationYear.filter(spec => {
            return spec.study_field_year_id === this.studyFieldYear.id
        });
    }
}
</script>
