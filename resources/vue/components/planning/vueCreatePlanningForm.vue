<template>
    <div class="space-y-8 mt-4">
        <vue-input
            v-model="studyName" 
            label="Name der Planung"
            name="name"
        >
        </vue-input>
        <vue-select
            v-model="selectedStudyProgram"
            :options="studyPrograms"
            class="w-full min-h-16"
            disabled
            label="Studiengang"
            name="studyProgram"
            optionKey="name"
        >
        </vue-select>
        <vue-select
            v-model="selectedStudyField"
            :options="availableStudyFields"
            class="w-full min-h-16"
            label="Studienrichtung"
            name="studyField"
            optionKey="name"
            required
            @input="selectStudyField"
        >
        </vue-select>
        <vue-select
            v-model="selectedSemester"
            :options="availabelSemesters"
            class="w-full min-h-16"
            label="Start"
            name="semester"
            optionKey="year"
            required
        >
        </vue-select>
        <vue-select
            v-if="availableSpecializations.length"
            v-model="selectedSpecialization"
            :disabled="!!selectedCrossQualification"
            :options="availableSpecializations"
            class="w-full min-h-16"
            clearable
            label="Spezialisierung"
            name="specialization"
            optionKey="name"

        >
        </vue-select>
        <vue-select
            v-if="availableCrossQualifications.length"
            v-model="selectedCrossQualification"
            :disabled="!!selectedSpecialization"
            :options="availableCrossQualifications"
            class="w-full min-h-16"
            clearable
            label="Querschnittqualifikation"
            name="crossQualification"
            optionKey="name"

        >
        </vue-select>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import VueSelect from "../form/vueSelect.vue";
import VueInput from "../form/vueInput.vue";
import {ISemester} from "../../interfaces/semester.interface";
import {IStudent} from "../../interfaces/student.interface";
import {IStudyProgram} from "../../interfaces/studyProgram.interface";
import {IStudyField} from "../../interfaces/studyField.interface";
import {IStudyFieldYear} from "../../interfaces/studyFieldYear.interface";
import {ISpecialization} from "../../interfaces/specialization.interface";
import {ICrossQualification} from "../../interfaces/crossQualification.interface";

@Component({
    components: {
        VueSelect,
        VueInput
    }
})
export default class VueCreatePlanningForm extends BaseComponent {
    @Prop({type: Array})
    studyPrograms: IStudyProgram[]

    @Prop({type: Array})
    studyFields: IStudyField[]

    @Prop({type: Array})
    semesters: ISemester[]

    @Prop({type: Array})
    studyFieldYears: IStudyFieldYear[]

    @Prop({type: Object})
    student: IStudent

    @Prop({type: Array})
    specializations: ISpecialization[]

    @Prop({type: Array})
    crossQualifications: ICrossQualification[]

    studyName: string = null;

    selectedStudyProgram: any = null;

    selectedStudyField: any = null;

    selectedSemester: any = null;

    selectedSpecialization: ISpecialization = null;

    selectedCrossQualification: ICrossQualification = null;

    public get availableStudyFields(): IStudyField[] {
        return this.studyFields.filter(
            (studyField) => {
                return studyField.study_program_id === this.selectedStudyProgram.id
            }
        ).filter(
            (studyField) => {
                return this.studyFieldYears.find(studyFieldYear => studyFieldYear.study_field_id === studyField.id)
            }
        );
    }

    public get availabelSemesters(): ISemester[] {
        if (!this.selectedStudyField) {
            return []
        }

        return this.studyFieldYears
            .filter(
                (studyFieldYear) => studyFieldYear.study_field_id === this.selectedStudyField.id
            )
            .map(
                (studyFieldYear) => this.semesters.find(
                    (semester) => semester.id === studyFieldYear.begin_semester_id
                )
            ).sort(function(a, b){return a.year - b.year});;
    }

    public get availableSpecializations(): ISpecialization[] {
        if (!this.selectedStudyField) {
            return [];
        }
        return this.specializations.filter((specialization) => specialization.study_field_id === this.selectedStudyField.id);
    }

    public get availableCrossQualifications(): ICrossQualification[] {
        if (!this.selectedStudyField) {
            return [];
        }
        return this.crossQualifications.filter((crossQualification) => crossQualification.study_field_id === this.selectedStudyField.id);
    }

    public created(): void {
        this.selectedStudyProgram = this.studyPrograms.find((studyProgram) => studyProgram.id === 6)
        if (this.student) {
            this.prefillFromStudent(this.student);
        }
    }

    public prefillFromStudent(student: IStudent) {
        if (!student.study_field_year_id) {
            return;
        }

        const studyFieldYear: IStudyFieldYear = this.studyFieldYears.find((studyFieldYear => studyFieldYear.id === student.study_field_year_id));

        if (!studyFieldYear) {
            return;
        }

        const studyField: IStudyField = this.studyFields.find((studyField) => studyField.id === studyFieldYear.study_field_id);

        if (!studyField) {
            return;
        }

        if (studyField.study_program_id !== 6) {
            return;
        }

        this.selectedStudyField = studyField;
        this.selectedSemester = this.semesters.find((semester) => semester.id === studyFieldYear.begin_semester_id);
    }

    public selectStudyField(studyField: IStudyField) {
        this.selectedCrossQualification = null;
        this.selectedSpecialization = null;
    }

}
</script>
