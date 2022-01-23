<template>
    <vue-card v-if="assessment">
        <template v-slot:title>
            <div class="flex flex-row justify-between">
                <div>
                    {{ assessment.name }}
                </div>
                <div>
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
            </div>
        </template>
        <div class="gap-2">
            <div>
                <div class="text-xs text-gray-600">Anzahl Kurse um zu bestehen</div>
                <div class="ml-2 text-sm">
                    <vue-store-input :edit-mode="editMode" :entity="assessment"
                                     :model="models.assessment" name="amount_to_pass"/>
                </div>
            </div>
            <div>
                <div class="text-xs text-gray-600">Module</div>

                <div class="text-sm space-y-2">
                    <vue-admin-course-pivot v-for="coursePivot in assessmentCourses"
                                            :course-pivot="coursePivot"
                                            :key="coursePivot.id"
                                            @remove="remove"
                    />
                </div>
                <vue-admin-backend-course-select
                    v-model="selectedCourse"
                    :disabled="!!selectedCourse"
                    @input="addCourse"
                    :course-ids-in-use="courseIdsInUse"
                    class="mt-4"
                />
            </div>
        </div>
    </vue-card>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../../base/baseComponent";
import VueCard from "../../base/vueCard.vue";
import VueAdminCoursePivot from "../vueAdminCoursePivot.vue";
import {IAssessmentCourse} from "../../../interfaces/assessmentCourse.interface";
import {ICourse} from "../../../interfaces/course.interface";
import VueAdminBackendCourseSelect from "../vueAdminBackendCourseSelect.vue";
import VueStoreInput from "../../form/storeInput.vue";

@Component({
    components: {
        VueCard,
        VueAdminCoursePivot,
        VueAdminBackendCourseSelect,
        VueStoreInput
    }
})
export default class VueAdminAssessment extends BaseComponent {
    @Prop({type: Number})
    public assessmentId: number

    public editMode = false;

    public selectedCourse: ICourse = null

    public get assessment() {
        return this.models.assessment.getById(this.assessmentId)
    }

    public get assessmentCourses() {
        return this.models.assessmentCourse.filter((assessmentCourse) => assessmentCourse.assessment_id === this.assessmentId)
    }

    public edit() {
        this.editMode = true;
    }

    public save() {
        this.models.assessment.save(this.assessmentId);
        this.editMode = false;
    }

    public cancel() {
        this.models.assessment.reset(this.assessmentId);
        this.editMode = false;
    }

    public remove(assessmentCourse: IAssessmentCourse) {
        this.models.assessmentCourse.delete(assessmentCourse.id);
    }

    public addCourse() {
        if (!this.selectedCourse) {
            return;
        }

        if (this.courseIdsInUse.includes(this.selectedCourse.id)) {
            return
        }

        this.models.course.add(this.selectedCourse);

        this.models.assessmentCourse.post(
            {
                course_id: this.selectedCourse.id,
                assessment_id: this.assessmentId
            }).finally(() => {
            this.selectedCourse = null;
        });
    }

    public get courseIdsInUse() {
        return this.assessmentCourses.map(assessmentCourse => assessmentCourse.course_id)
    }

}
</script>
