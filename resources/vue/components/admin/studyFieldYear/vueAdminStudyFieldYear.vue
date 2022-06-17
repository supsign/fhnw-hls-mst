<template>
    <vue-card v-if="studyFieldYear">
        <template v-slot:title>
            <div class="flex flex-row justify-between">
                <div>{{ studyField.name }}</div>
                <div v-if="!editMode" class="cursor-pointer" @click="edit">
                    <i aria-hidden="true" class="far fa-edit"></i>
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
        </template>
        <div class="space-y-2">
            <div>
                <div class="text-xs text-gray-600">Musterstudienplan</div>
                <div class="text-sm">
                    <vue-store-select
                        :edit-mode="editMode"
                        :entity="studyFieldYear"
                        :model="models.studyFieldYear"
                        :related-filter="(rec) => rec.study_field_id === studyFieldYear.study_field_id"
                        :related-model="models.recommendation"
                        label="name"
                        name="recommendation_id"
                    />
                </div>
            </div>
            <div>
                <div class="text-xs text-gray-600">Assessment</div>
                <div class="text-sm">
                    <vue-store-select
                        :edit-mode="editMode"
                        :entity="studyFieldYear"
                        :model="models.studyFieldYear"
                        :related-filter="(ass) => ass.study_field_id === studyFieldYear.study_field_id"
                        :related-model="models.assessment"
                        label="name"
                        name="assessment_id"
                    />
                </div>
            </div>
            <div>
                <div class="text-xs text-gray-600">Studienrichtung</div>
                <div class="text-sm">
                    <div class="px-6 py-2">{{ studyField.name }}</div>
                </div>
            </div>
            <div>
                <div class="text-xs text-gray-600">Start</div>
                <div class="text-sm">
                    <div class="px-6 py-2">{{ semester.year }}</div>
                </div>
            </div>
            <div>
                <div class="text-xs text-gray-600">Modulgruppen</div>
                <div class="text-sm space-y-2 pt-2">
                    <div v-for="courseGroup in courseGroups" class="px-6">{{ courseGroup.name }}</div>
                </div>
            </div>
            <div class="flex flex-row start-">
                <div>
                    <a :href="`/admin/studyFieldYears/${studyFieldYearId}/courseGroups`" class="button-primary mt-8">
                        Module in Gruppen anpassen
                    </a>
                </div>
            </div>
        </div>
    </vue-card>
</template>

<script lang="ts">
import { Component, Prop } from 'vue-property-decorator';
import BaseComponent from '../../base/baseComponent';
import VueCard from '../../base/vueCard.vue';
import VueAdminBackendCourseSelect from '..//vueAdminBackendCourseSelect.vue';
import VueStoreInput from '../../form/storeInput.vue';
import VueStoreSelect from '../../form/storeSelect.vue';
import VueAdminCoursePivot from '../vueAdminCoursePivot.vue';
import { IStudyFieldYear } from '../../../interfaces/studyFieldYear.interface';
import { IStudyField } from '../../../interfaces/studyField.interface';
import { ISemester } from '../../../interfaces/semester.interface';
import { ICourseGroup } from '../../../store/courseGroup/courseGroup.interface';

@Component({
    components: {
        VueCard,
        VueAdminBackendCourseSelect,
        VueStoreInput,
        VueStoreSelect,
        VueAdminCoursePivot,
    },
})
export default class VueAdminStudyFieldYear extends BaseComponent {
    @Prop({ type: Number })
    studyFieldYearId: number;

    @Prop({ type: Object })
    studyField: IStudyField;

    @Prop({ type: Object })
    semester: ISemester;

    @Prop({ type: Array })
    courseGroups: ICourseGroup[];

    public editMode = false;

    public get studyFieldYear(): IStudyFieldYear {
        return this.models.studyFieldYear.getById(this.studyFieldYearId);
    }

    public edit() {
        this.editMode = true;
    }

    public save() {
        this.models.studyFieldYear.save(this.studyFieldYearId);
        this.editMode = false;
    }

    public cancel() {
        this.models.studyFieldYear.reset(this.studyFieldYearId);
        this.editMode = false;
    }
}
</script>
