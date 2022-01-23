<template>
    <vue-card v-if="recommendation">
        <template v-slot:title>
            <div class="flex flex-row">
                <div>
                    {{ recommendation.name }}
                </div>
            </div>
        </template>
        <div class="flex flex-col gap-6">
            <vue-admin-course-recommendations
                v-for="semester in [1,2,3,4,5,6]"
                :semester="semester"
                :recommendation-id="recommendationId"
                :key="semester"/>
        </div>
    </vue-card>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../../base/baseComponent";
import VueCard from "../../base/vueCard.vue";
import VueAdminCoursePivot from "../vueAdminCoursePivot.vue";
import VueAdminBackendCourseSelect from "../vueAdminBackendCourseSelect.vue";
import VueAdminCourseRecommendations from "./vueAdminCourseRecommendations.vue";

@Component({
    components: {
        VueAdminCourseRecommendations,
        VueCard,
        VueAdminCoursePivot,
        VueAdminBackendCourseSelect
    }
})
export default class VueAdminRecommendation extends BaseComponent {
    @Prop({type: Number})
    public recommendationId: number

    public get recommendation() {
        return this.models.recommendation.getById(this.recommendationId)
    }

}
</script>
