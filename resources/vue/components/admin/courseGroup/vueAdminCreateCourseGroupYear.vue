<template>
    <vue-card>
        <template slot="title">
            <div>Erstellen</div>
        </template>
        <div class="flex flex-col gap-5">
            <div class="grid grid-cols-2 gap-5 divide-x">
                <vue-select
                    v-model="courseGroupYear.course_group"
                    :options="models.courseGroup.all"
                    class="w-full min-h-16"
                    label="Modulgruppe"
                    optionKey="name"
                    @input="resetName"
                ></vue-select>
                <vue-input type="text" label="Name" v-model="name" @input="resetSelect" class="pl-5" />
            </div>
            <vue-input type="number" label="Benötigte Punkte" v-model="courseGroupYear.credits_to_pass" />
            <vue-input type="number" label="Benötigte Kurse" v-model="courseGroupYear.amount_to_pass" />
            <button
                class="button-primary w-full lg:w-60"
                @click="createCourseGroupYear"
                :disabled="isDisabled"
                :class="{ 'opacity-50 cursor-not-allowed': isDisabled }"
            >
                Modulgruppe Erstellen
            </button>
        </div>
    </vue-card>
</template>
<script lang="ts">
import Component from 'vue-class-component';
import { ICourseGroupYear } from '../../../interfaces/courseGroupYear.interface';
import { ICourseGroup } from '../../../store/courseGroup/courseGroup.interface';
import BaseComponent from '../../base/baseComponent';
import VueCard from '../../base/vueCard.vue';
import VueSelect from '../../form/vueSelect.vue';
import VueInput from '../../form/vueInput.vue';
import { IStudyFieldYear } from '../../../interfaces/studyFieldYear.interface';
import { Prop } from 'vue-property-decorator';

@Component({
    components: {
        VueCard,
        VueInput,
        VueSelect,
    },
})
export default class VueAdminCreateCourseGroupYear extends BaseComponent {
    @Prop({ type: Object })
    public studyFieldYear: IStudyFieldYear;

    public courseGroupYear: ICourseGroupYear = {
        id: 0,
        course_group: { id: 0, name: '' },
        course_group_id: 0,
        course_course_group_years: [],
        study_field_year_id: 0,
        credits_to_pass: null,
    };
    public name: string = null;

    public getCourseGroupName(course: ICourseGroup) {
        return course.name;
    }
    public getCourseSearchParams(search: string) {
        return { search };
    }
    public createCourseGroupYear() {
        if (this.name) {
            this.courseGroupYear.course_group.name = this.name;
        }
        this.models.courseGroupYear.post(this.courseGroupYearPostRequest(this.courseGroupYear)).then(res => this.models.courseGroup.add(res.course_group))

    }

    public resetSelect() {
        this.courseGroupYear.course_group = { id: 0, name: '' };
    }
    public resetName() {
        this.name = '';
    }

    public get isDisabled() {
        if (!this.courseGroupYear.course_group.name && !this.name) {
            return true;
        }
        return false;
    }

    public courseGroupYearPostRequest(courseGroupYear: ICourseGroupYear) {
        const data = {
            study_field_year_id: this.studyFieldYear ? this.studyFieldYear.id : 0,
            credits_to_pass: courseGroupYear.credits_to_pass,
        };
        if (courseGroupYear.course_group.id) {
            return {
                ...data,
                course_group_id: courseGroupYear.course_group.id
            };
        } else {
            return {
                ...data,
                course_group_name: courseGroupYear.course_group.name,
            };
        }
    }
}
</script>
