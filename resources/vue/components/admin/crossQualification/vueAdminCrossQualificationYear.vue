<template>
    <vue-card v-if="crossQualification">
        <template v-slot:title>
            <div class="flex flex-row justify-between">
                <div>{{ crossQualification.name }}</div>
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
                <div class="ml-2 text-sm">
                    <vue-store-select
                        name="recommendation_id"
                        :entity="crossQualificationYear"
                        :edit-mode="editMode"
                        :model="models.crossQualificationYear"
                        :related-model="models.recommendation"
                        label="name"
                        clearable
                    />
                </div>
            </div>
            <div>
                <div class="text-xs text-gray-600">Assessment</div>
                <div class="ml-2 text-sm">
                    <vue-store-select
                        name="assessment_id"
                        :entity="crossQualificationYear"
                        :edit-mode="editMode"
                        :model="models.crossQualificationYear"
                        :related-model="models.assessment"
                        label="name"
                        clearable
                    />
                </div>
            </div>
            <div>
                <div class="text-xs text-gray-600">Anzahl Kurse um zu bestehen</div>
                <div class="ml-2 text-sm">
                    <vue-store-input :edit-mode="editMode" :entity="crossQualificationYear"
                                     :model="models.crossQualificationYear" name="amount_to_pass"/>
                </div>
            </div>
            <div>
                <div class="text-xs text-gray-600">Module</div>
                <div class="ml-2 text-sm space-y-2">
                    <vue-admin-course-pivot v-for="coursePivot in courseCrossQualificationYears"
                                            :course-pivot="coursePivot"
                                            @remove="remove"
                                            :key="coursePivot.id"
                    />
                    <div>
                        <vue-admin-backend-course-select
                            v-model="selectedCourse"
                            :disabled="!!selectedCourse"
                            @input="addCourse"
                            :course-ids-in-use="courseIdsInUse"
                            class="mt-4"
                        ></vue-admin-backend-course-select>
                    </div>

                </div>
            </div>
        </div>
    </vue-card>
</template>

<script lang="ts">
import {Component, Prop,} from "vue-property-decorator";
import BaseComponent from "../../base/baseComponent";
import VueCard from "../../base/vueCard.vue";
import VueAdminBackendCourseSelect from "..//vueAdminBackendCourseSelect.vue"
import {ICourse} from "../../../interfaces/course.interface";
import VueStoreInput from "../../form/storeInput.vue";
import VueStoreSelect from "../../form/storeSelect.vue";
import {ICrossQualificationYear} from "../../../interfaces/crossQualificationYear.interface";
import {ICourseCrossQualificationYear} from "../../../interfaces/courseCrossQualificationYear.interface";
import VueAdminCoursePivot from "../vueAdminCoursePivot.vue";


@Component({
    components: {
        VueCard,
        VueAdminBackendCourseSelect,
        VueStoreInput,
        VueStoreSelect,
        VueAdminCoursePivot
    }
})
export default class VueAdminCrossQualificationYear extends BaseComponent {
    @Prop({type: Object})
    crossQualificationYear: ICrossQualificationYear

    public selectedCourse: ICourse = null;

    public editMode = false;

    public get assessment() {
        return this.models.assessment.getById(this.crossQualificationYear.assessment_id)
    }

    public get crossQualification() {
        return this.models.crossQualification.getById(this.crossQualificationYear.cross_qualification_id)
    }

    public get courseCrossQualificationYears() {
        return this.models.courseCrossQualificationYear.filter(
            coursePivot => coursePivot.cross_qualification_year_id === this.crossQualificationYear.id
        )
    }

    public edit() {
        this.editMode = true;
    }

    public getCourse(id: number) {
        return this.models.course.getById(id);
    }

    public addCourse() {
        if (!this.selectedCourse) {
            return;
        }

        if (this.courseIdsInUse.includes(this.selectedCourse.id)) {
            return
        }

        this.models.course.add(this.selectedCourse);

        this.models.courseCrossQualificationYear.post(
            {
                course_id: this.selectedCourse.id,
                cross_qualification_year_id: this.crossQualificationYear.id
            }).finally(() => {
            this.selectedCourse = null;
        });
    }

    public get courseIdsInUse() {
        return this.courseCrossQualificationYears.map(courseCrossQualificationYear => courseCrossQualificationYear.course_id);
    }

    public remove(courseCrossQualificationYear: ICourseCrossQualificationYear) {
        this.models.courseCrossQualificationYear.delete(courseCrossQualificationYear.id)
    }

    public save() {
        this.editMode = false;
        this.models.crossQualificationYear.save(this.crossQualificationYear.id);
    }

    public cancel() {
        this.editMode = false;
        this.models.crossQualificationYear.reset(this.crossQualificationYear.id);
    }
}
</script>
