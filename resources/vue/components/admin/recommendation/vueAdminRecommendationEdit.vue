<template>
    <vue-card v-if="recommendation">
        <template v-slot:title>
            <div class="flex flex-row justify-between">
                <div>
                    <vue-store-input
                        :edit-mode="editMode"
                        :entity="recommendation"
                        :model="models.recommendation"
                        name="name"
                    />
                </div>
                <div>
                    <div v-if="!editMode" class="flex flex-row gap-2">
                        <div class="cursor-pointer" @click="edit">
                            <i aria-hidden="true" class="far fa-edit"></i>
                        </div>
                        <div class="cursor-pointer">
                            <a :href="`/admin/recommendations/${recommendationId}/copy`">
                                <i aria-hidden="true" class="far fa-copy"></i>
                            </a>
                        </div>
                    </div>
                    <div v-else class="flex felx-row space-x-2">
                        <div class="cursor-pointer" @click="cancel">
                            <i aria-hidden="true" class="far fa-times"></i>
                        </div>
                        <div class="cursor-pointer" @click="save">
                            <i aria-hidden="true" class="far fa-save"></i>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <div class="flex flex-col gap-6">
            <vue-admin-course-recommendations
                v-for="semester in [1, 2, 3, 4, 5, 6]"
                :key="semester"
                :recommendation-id="recommendationId"
                :semester="semester"
            />
        </div>
    </vue-card>
</template>

<script lang="ts">
import { Component, Prop } from 'vue-property-decorator';
import BaseComponent from '../../base/baseComponent';
import VueCard from '../../base/vueCard.vue';
import VueAdminCourseRecommendations from './vueAdminCourseRecommendations.vue';
import VueStoreInput from '../../form/storeInput.vue';

@Component({
    components: {
        VueAdminCourseRecommendations,
        VueCard,
        VueStoreInput,
    },
})
export default class VueAdminRecommendation extends BaseComponent {
    @Prop({ type: Number })
    public recommendationId: number;

    public editMode = false;

    public get recommendation() {
        return this.models.recommendation.getById(this.recommendationId);
    }

    public edit() {
        this.editMode = true;
    }

    public save() {
        this.models.recommendation.save(this.recommendationId);
        this.editMode = false;
    }

    public cancel() {
        this.models.recommendation.reset(this.recommendationId);
        this.editMode = false;
    }
}
</script>
