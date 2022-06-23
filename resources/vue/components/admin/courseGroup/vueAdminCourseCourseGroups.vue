<template>
    <vue-card v-if="courseGroup">
        <template slot="title">
            <div class="flex flex-row justify-between items-center">
                <div>
                    {{ courseGroup.name }}
                </div>
                <div class="flex flex-row space-x-2 items-center text-">
                    <div>Benötigte&nbsp;Punkte:</div>
                    <vue-store-input
                        :edit-mode="editMode"
                        :entity="courseGroupYear"
                        :model="models.courseGroupYear"
                        class="w-24"
                        name="credits_to_pass"
                        type="number"
                    />
                    <div v-if="!editMode" class="cursor-pointer" @click="edit">
                        <i aria-hidden="true" class="far fa-edit"></i>
                    </div>
                    <div
                        v-if="
                            !editMode &&
                            !courseCourseGroupYears.length
                        "
                        class="cursor-pointer"
                        @click="deleteCourseYear"
                    >
                        <i aria-hidden="true" class="far fa-trash"></i>
                    </div>
                    <div v-if="editMode" class="flex flex-row gap-x-10">
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
        <div class="text-sm space-y-2">
            <div
                v-for="courseCourseGroupYear in courseCourseGroupYears"
                :key="courseCourseGroupYear.id"
                class="flex flex-row gap-4"
            >
                <vue-admin-course-pivot :course-pivot="courseCourseGroupYear" @remove="remove" />
                <div v-if="getCourse(courseCourseGroupYear)">({{ getCourse(courseCourseGroupYear).credits }} ECTS)</div>
            </div>
            <div class="mt-8">
                <vue-admin-backend-course-select
                    v-model="selectedCourse"
                    :course-ids-in-use="courseIdsInUse"
                    :disabled="!!selectedCourse"
                    class="mt-4"
                    @input="addCourse"
                ></vue-admin-backend-course-select>
            </div>
        </div>
    </vue-card>
</template>

<script lang="ts">
import { Component, Prop } from 'vue-property-decorator';
import BaseComponent from '../../base/baseComponent';
import { ICourseGroupYear } from '../../../interfaces/courseGroupYear.interface';
import VueCard from '../../base/vueCard.vue';

import { ICourse } from '../../../interfaces/course.interface';
import { ICourseCourseGroupYear } from '../../../store/courseCourseGroupYear/courseCourseGroupYear.interface';
import VueAdminBackendCourseSelect from '../vueAdminBackendCourseSelect.vue';
import VueStoreInput from '../../form/storeInput.vue';
import VueAdminCoursePivot from '../vueAdminCoursePivot.vue';

@Component({
    components: {
        VueAdminBackendCourseSelect,
        VueAdminCoursePivot,
        VueCard,
        VueStoreInput,
    },
})
export default class VueAdminCourseCourseGroups extends BaseComponent {
    @Prop({ type: Object })
    public courseGroupYear: ICourseGroupYear;

    public selectedCourse: ICourse = null;

    public editMode = false;

    public get courseGroup() {
        return this.models.courseGroup.getById(this.courseGroupYear.course_group_id);
    }

    public get courseCourseGroupYears(): ICourseCourseGroupYear[] {
        return this.models.courseCourseGroupYear.all.filter(
            (courseCourseGroupYear) => courseCourseGroupYear.course_group_year_id === this.courseGroupYear.id
        );
    }

    public get courseIdsInUse() {
        return this.courseCourseGroupYears.map((courseCourseGroupYear) => courseCourseGroupYear.course_id);
    }

    public remove(courseCourseGroupYear: ICourseCourseGroupYear) {
        this.models.courseCourseGroupYear.delete(courseCourseGroupYear.id);
    }

    public addCourse() {
        if (!this.selectedCourse) {
            return;
        }

        if (
            this.courseCourseGroupYears.find(
                (courseCourseGroupYears) => courseCourseGroupYears.course_id === this.selectedCourse.id
            )
        ) {
            return;
        }

        this.models.course.add(this.selectedCourse);

        this.models.courseCourseGroupYear
            .post({
                course_id: this.selectedCourse.id,
                course_group_year_id: this.courseGroupYear.id,
            })
            .finally(() => {
                console.log('blub');
                this.selectedCourse = null;
            });
    }

    public edit() {
        this.editMode = true;
    }

    public deleteCourseYear() {
        this.models.courseGroupYear.delete(this.courseGroupYear.id);
    }

    public save() {
        this.editMode = false;
        this.models.courseGroupYear.save(this.courseGroupYear.id);
    }

    public cancel() {
        this.editMode = false;
        this.models.courseGroupYear.reset(this.courseGroupYear.id);
    }

    public getCourse(courseCourseGroupYear: ICourseCourseGroupYear): ICourse {
        return this.models.course.getById(courseCourseGroupYear.course_id);
    }
}
</script>
