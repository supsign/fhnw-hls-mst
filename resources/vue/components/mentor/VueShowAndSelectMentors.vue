<template>
    <div class="p-2 rounded  bg-white flex flex-col shadow-xl">
        <div class="divide-y p-3 text-sm md:text-base flex-grow">
            <div class="pb-2 flex flex-row justify-between">
                <div>Freigegebene Stgl</div>
                <div>
                    <button v-if="studyField" class="button-primary"
                            @click="approve">freigeben
                    </button>
                </div>
            </div>
            <div>
                <!--        <vue-select v-model="selectedMentor" :name="'Mentor:in'" :options="availableMentors"-->
                <!--                    :search-keys="['firstname', 'lastname']"-->
                <!--                    :show-option="showOption" class="mt-4" searchable @input="selectMentor"></vue-select>-->

                <div v-if="!studyField">Bitte wenden sie sich an die Administration, um Planungen für Stgl
                    freizugeben.
                </div>
                <div class="mt-4 space-y-2">
                    <div v-if="!myMentors.length">Keine Freigaben erteilt</div>
                    <div v-for="mentor in myMentors">
                        <span @click="()=>remove(mentor)">
                            <i aria-hidden="true" class="far fa-trash alt mr-2 cursor-pointer"> </i>
                        </span>
                        {{ mentor.firstname }} {{ mentor.lastname }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {IMentor} from "../../interfaces/mentor.interface";
import VueSelect from "../form/vueSelect.vue";
import axios from "axios";
import {Toast} from "../../helpers/toast";
import {IStudyField} from "../../interfaces/studyField.interface";

@Component({
    components: {VueSelect}
})
export default class VueShowAndSelectMentors extends BaseComponent {

    @Prop({type: Array})
    public allMentors: IMentor[];

    @Prop({type: Array})
    public initMyMentors: IMentor[];

    @Prop({type: Object})
    public studyField: IStudyField;

    public myMentors: IMentor[] = [];

    public selectedMentor: IMentor = null;

    public get availableMentors() {
        return this.allMentors.filter(mentor => !this.myMentors.find(myMentor => mentor.id === myMentor.id))
    }

    public created() {
        this.myMentors = this.initMyMentors;
    }

    public selectMentor(mentor: IMentor): void {
        this.saveSelectedMentor(mentor);
        this.myMentors.push(mentor);
        this.selectedMentor = null;
    }

    public showOption(mentor: IMentor) {
        return mentor.firstname + ' ' + mentor.lastname
    }

    public saveSelectedMentor(mentor: IMentor) {
        axios.post<IMentor>(`/webapi/mentor/${mentor.id}/attache`)
            .then(() => Toast.fire({title: 'Mentor hinzugefügt', icon: 'success'}))
            .catch(() => {
                const index = this.myMentors.findIndex((myMentor) => myMentor.id === mentor.id);
                if (index === -1) {
                    return;
                }
                this.myMentors.splice(index, 1);
            })
    }

    public approve() {
        if (!this.studyField) {
            return;
        }
        const mentors = this.availableMentors
            .filter(mentor => {
                return mentor.mentor_study_fields?.find(mentorStudyField => {
                    return mentorStudyField.study_field_id === this.studyField.id
                })
            });
        mentors.forEach(mentor => this.selectMentor(mentor));
    }

    public remove(mentor: IMentor) {
        const index = this.myMentors.findIndex((myMentor) => myMentor.id === mentor.id);
        if (index === -1) {
            return;
        }
        this.myMentors.splice(index, 1);
        axios.delete(`/webapi/mentor/${mentor.id}/attache`)
            .then(() => Toast.fire({title: 'Mentor enfernt', icon: 'success'}))
            .catch(() => {
                this.myMentors.push(mentor);
            })
    }


}
</script>
