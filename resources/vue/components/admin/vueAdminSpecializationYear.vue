<template>
    <div>

        Spezialisierungen

        <div class="grid grid-cols-3 gap-4">
            <div v-for="specializationYear in specializationYears">
                <vue-card v-if="getSpecialization(specializationYear.specialization_id)">
                    <template v-slot:title>{{ getSpecialization(specializationYear.specialization_id).name }}</template>
                    <vue-input v-model="specializationYear->assessment" label="Assesmment"></vue-input>
                </vue-card>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import VueCard from "../base/vueCard.vue";
import {ISpecializationYear} from "../../interfaces/specialzationYear.interface";
import {ISpecialization} from "../../interfaces/specialization.interface";
import VueInput from "../form/vueInput.vue";

@Component({
    components: {
        VueCard,
        VueInput
    }
})
export default class VueAdminSpecializationYear extends BaseComponent {

    @Prop({type: Array})
    specializationYears: ISpecializationYear[]

    @Prop({type: Array})
    specializations: ISpecialization[]

    public getSpecialization(id: Number): ISpecialization {
        return this.specializations.find((spez) => spez.id === id);
    }
}
</script>
