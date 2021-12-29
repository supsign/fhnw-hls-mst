<template>
    <vue-card>
        <template v-slot:title>
            <div class="flex flex-row justify-between">
                <div>{{ specialization.name }}</div>
                <div class="cursor-pointer" @click="()=>editSpez(specializationYear)">
                    <i aria-hidden="true" class="far fa-edit"></i>
                </div>
            </div>
        </template>
        <div>
            <div>Assessment</div>
            <div v-if="assessemnt">{{ assessemnt.name }}</div>
            <div v-else>Kein abweichendes Assessment</div>
        </div>
    </vue-card>
</template>

<script lang="ts">
import {Component, Prop,} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ISpecializationYear} from "../../interfaces/specialzationYear.interface";
import VueCard from "../base/vueCard.vue";


@Component({
    components: {
        VueCard
    }
})
export default class VueAdminSpecializationYear extends BaseComponent {
    @Prop({type: Object})
    specializationYear: ISpecializationYear

    public get assessemnt() {
        return this.models.assessment.getById(this.specializationYear.assessment_id)
    }

    public get specialization() {
        return this.models.specialization.getById(this.specializationYear.specialization_id)
    }

    public editSpez(specializationYear: ISpecializationYear) {
        console.log('specializationYear: ', specializationYear)
    }
}
</script>
