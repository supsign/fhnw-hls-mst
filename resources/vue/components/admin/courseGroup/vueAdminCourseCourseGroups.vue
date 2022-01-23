<template>
    <vue-card v-if="courseGroup">
        <template slot="title">
            <div class="flex flex-row justify-between items-center">
                <div>
                    {{ courseGroup.name }}
                </div>
                <div class="flex flex-row space-x-2 items-center text-">
                    <div>Benötigte&nbsp;Punkte:</div>
                    <vue-store-input :model="models.courseGroupYear" :entity="courseGroupYear" name="credits_to_pass"
                                     :edit-mode="editMode" type="number" class="w-24"/>
                    <div v-if="!editMode" class="cursor-pointer" @click="editMode=true">
                        <i class="far fa-edit" aria-hidden="true"></i>
                    </div>
                    <div v-else class="cursor-pointer" @click="save">
                        <i class="far fa-save" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </template>
        <div class="text-sm space-y-2">
            <vue-admin-course-pivot
                v-for="courseCourseGroupYear in courseCourseGroupYears"
                :key="courseCourseGroupYear.id"
                :course-pivot="courseCourseGroupYear"
                @remove="remove"
            />
            <vue-admin-backend-course-select
                v-model="selectedCourse"
                :disabled="!!selectedCourse"
                @input="addCourse"
                :course-ids-in-use="courseIdsInUse"
                class="mt-4"
            ></vue-admin-backend-course-select>
        </div>
    </vue-card>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../../base/baseComponent";
import {ICourseGroupYear} from "../../../interfaces/courseGroupYear.interface";
import VueCard from "../../base/vueCard.vue";

import {ICourse} from "../../../interfaces/course.interface";
import {ICourseCourseGroupYear} from "../../../store/courseCourseGroupYear/courseCourseGroupYear.interface";
import VueAdminBackendCourseSelect from "../vueAdminBackendCourseSelect.vue";
import VueStoreInput from "../../form/storeInput.vue"
import VueAdminCoursePivot from "../vueAdminCoursePivot.vue";

@Component({
    components: {
        VueAdminBackendCourseSelect,
        VueAdminCoursePivot,
        VueCard,
        VueStoreInput
    }
})
export default class VueAdminCourseCourseGroups extends BaseComponent {

    @Prop({type: Object})
    public courseGroupYear: ICourseGroupYear

    public selectedCourse: ICourse = null;

    public editMode = false;

    public get courseGroup() {
        return this.models.courseGroup.getById(this.courseGroupYear.course_group_id)
    }

    public get courseCourseGroupYears(): ICourseCourseGroupYear[] {
        return this.models.courseCourseGroupYear.all.filter(courseCourseGroupYear => courseCourseGroupYear.course_group_year_id === this.courseGroupYear.id)
    }

    public get courseIdsInUse() {
        return this.courseCourseGroupYears.map(courseCourseGroupYear => courseCourseGroupYear.course_id);
    }

    public remove(courseCourseGroupYear: ICourseCourseGroupYear) {
        this.models.courseCourseGroupYear.delete(courseCourseGroupYear.id);
    }

    public addCourse() {
        if (!this.selectedCourse) {
            return;
        }

        if (this.courseCourseGroupYears.find(courseCourseGroupYears => courseCourseGroupYears.course_id === this.selectedCourse.id)) {
            return;
        }

        this.models.course.add(this.selectedCourse);

        this.models.courseCourseGroupYear.post(
            {
                course_id: this.selectedCourse.id,
                course_group_year_id: this.courseGroupYear.id
            }).finally(() => {
            console.log('blub')
            this.selectedCourse = null;
        });
    }

    public save() {
        this.editMode = false;
        this.models.courseGroupYear.save(this.courseGroupYear.id);
    }


}
</script>
