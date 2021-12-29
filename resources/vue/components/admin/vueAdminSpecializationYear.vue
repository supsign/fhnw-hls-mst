<template>
    <div class="mb-2">

        Spezialisierungen

        <div class="grid grid-cols-3 gap-4">
            <div v-for="specializationYear in specializationYears">
                <vue-card v-if="getSpecialization(specializationYear.specialization_id)">
                    <template v-slot:title>
                        <div class="flex flex-row justify-between">
                            <div>{{ getSpecialization(specializationYear.specialization_id).name }}</div>
                            <div class="cursor-pointer" @click="()=>editSpez(specializationYear)">
                                <i aria-hidden="true" class="far fa-edit"></i>
                            </div>
                        </div>
                    </template>
                    <vue-admin-spez-assesment :assessments=""/>
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
import VueAdminSpezAssesment from "./vueAdminSpezAssesment.vue";

@Component({
    components: {
        VueAdminSpezAssesment,
        VueCard,
        VueInput
    }
})
export default class VueAdminSpecializationYear extends BaseComponent {

    @Prop({type: Array})
    specializationYears: ISpecializationYear[]

    @Prop({type: Array})
    specializations: ISpecialization[]

    @Prop({type: Array})


    public getSpecialization(id: Number): ISpecialization {
        return this.specializations.find((spez) => spez.id === id);
    }

    public editSpez(specializationYear: ISpecializationYear) {
        console.log('specializationYear: ', specializationYear)
    }
}
</script>
