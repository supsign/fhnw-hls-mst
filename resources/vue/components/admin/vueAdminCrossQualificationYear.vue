<template>
    <div class="p-2 rounded  bg-white flex flex-col shadow-xl">
        <div class="content-center p-2 border-b rounded-t text-base md:text-lg">
            <div class="flex flex-row justify-between">
                {{ crossQualification.name }}
                <div v-if="!editModeisActive" class="cursor-pointer" @click="edit">
                    <i aria-hidden="true" class="far fa-edit"></i>
                </div>
                <div v-else class="flex flex-row">
                    <div class="cursor-pointer" @click="cancel"><i aria-hidden="true" class="far fa-times"></i></div>
                    <div class="cursor-pointer ml-2" @click="save"><i aria-hidden="true" class="far fa-save"></i></div>
                </div>
            </div>

        </div>
        <div class="p-3 text-sm md:text-base flex-grow">
            <div class="text-grey">
                Studienrichtung
            </div>
            <div class="ml-2">
                {{ studyField.name }}
            </div>
            <div class="text-grey">
                Start:
            </div>
            <div class="ml-2">
                {{ semester.year }}
            </div>
            <div class="text-grey">
                Anzahl zum Bestehen:
            </div>
            <div v-if="!editModeisActive" class="ml-2">
                {{ crossQualificationYear.amount_to_pass }}
            </div>
            <vue-input v-else v-model="amountToPass"></vue-input>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import VueToggleMentorStudyField from "./vueToggleMentorStudyField.vue";
import VueBackendSelect from "../form/backendSelect.vue";
import {ISemester} from "../../interfaces/semester.interface";
import {ICrossQualificationYear} from "../../interfaces/crossQualificationYear.interface";
import {ICrossQualification} from "../../interfaces/crossQualification.interface";
import {IStudyField} from "../../interfaces/studyField.interface";
import VueInput from "../form/vueInput.vue";
import axios from "axios";

@Component({
    components: {VueToggleMentorStudyField, VueBackendSelect, VueInput}
})
export default class VueAdminCrossQualificationYear extends BaseComponent {

    @Prop({type: Object})
    public studyField: IStudyField;

    @Prop({type: Object})
    public semester: ISemester

    @Prop({type: Object})
    public initCrossQualificationYear: ICrossQualificationYear

    @Prop({type: Object})
    public crossQualification: ICrossQualification

    public crossQualificationYear: ICrossQualificationYear = null

    public amountToPass = "";

    public editModeisActive = false;

    public created() {
        this.crossQualificationYear = this.initCrossQualificationYear;
    }

    public edit() {
        this.editModeisActive = true;
        this.amountToPass = this.crossQualificationYear.amount_to_pass.toString();
    }

    public save() {
        this.editModeisActive = false;
        this.crossQualificationYear.amount_to_pass = parseInt(this.amountToPass, 10);
        axios.patch<ICrossQualificationYear>(`/webapi/crossqualificationyears/${this.crossQualificationYear.id}`, this.crossQualificationYear)
            .then((res) => {
                this.crossQualificationYear = res.data
            })
    }

    public cancel() {
        this.editModeisActive = false;
    }


}
</script>
