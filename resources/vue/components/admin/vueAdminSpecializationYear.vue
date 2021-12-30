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
        <div class="space-y-2">
            <div>
                <div class="text-xs text-gray-600">Assessment</div>
                <div class="ml-2 text-sm">
                    <div v-if="assessemnt">{{ assessemnt.name }}</div>
                    <div v-else>Kein abweichendes Assessment</div>
                </div>
            </div>
            <div>
                <div class="text-xs text-gray-600">Anzahl Kurse um zu bestehen</div>
                <div class="ml-2 text-sm">
                    <div>{{ specializationYear.amount_to_pass }}</div>
                </div>
            </div>
            <div>
                <div class="text-xs text-gray-600">Module</div>
                <div class="ml-2 text-sm space-y-1">
                    <div v-for="coursePivot in courseSpecializationYears">{{
                            getCourse(coursePivot.course_id).name
                        }}
                    </div>
                </div>
            </div>
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

    public get courseSpecializationYears() {
        return this.models.courseSpecializationYear.filter(
            coursePivot => coursePivot.specialization_year_id === this.specializationYear.id
        )
    }

    public editSpez(specializationYear: ISpecializationYear) {
        console.log('specializationYear: ', specializationYear)
    }

    public getCourse(id: number) {
        return this.models.course.getById(id);
    }
}
</script>
