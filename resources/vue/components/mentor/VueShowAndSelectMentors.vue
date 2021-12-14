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
                    <div v-if="!mentorStudents.length">Keine Freigaben erteilt</div>
                    <div v-for="mentorStudent in mentorStudents">
                        <span @click="()=>remove(mentorStudent)">
                            <i aria-hidden="true" class="far fa-trash alt mr-2 cursor-pointer"> </i>
                        </span>
                        <span v-if="getMentorByMentorStudent(mentorStudent)">
                            {{ getMentorByMentorStudent(mentorStudent).firstname }}
                            {{ getMentorByMentorStudent(mentorStudent).lastname }}
                        </span>

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
import {IMentorStudent} from "../../interfaces/mentorStudent.interface";

@Component({
    components: {VueSelect}
})
export default class VueShowAndSelectMentors extends BaseComponent {

    @Prop({type: Array})
    public allMentors: IMentor[];

    @Prop({type: Array})
    public initMentorStudents: IMentorStudent[];

    @Prop({type: Object})
    public studyField: IStudyField;

    @Prop({type: Number})
    public studentId: number;

    public mentorStudents: IMentorStudent[] = [];

    public selectedMentor: IMentor = null;

    public get availableMentors() {
        return this.allMentors.filter(mentor => !this.mentorStudents.find(mentorStudent => mentor.id === mentorStudent.mentor_id))
    }

    public created() {
        this.mentorStudents = this.initMentorStudents;
    }

    public selectMentor(mentor: IMentor): void {
        this.saveSelectedMentor(mentor);
        this.mentorStudents.push({
            mentor_id: mentor.id,
            id: 0,
            student_id: this.studentId,
            firstname: 'temp',
            lastname: 'temp'
        });
        this.selectedMentor = null;
    }

    public showOption(mentor: IMentor) {
        return mentor.firstname + ' ' + mentor.lastname
    }

    public saveSelectedMentor(mentor: IMentor) {
        axios.post<IMentorStudent>(`/webapi/mentor/${mentor.id}/students/${this.studentId}`)
            .then((res) => {
                Toast.fire({title: 'Mentor hinzugefügt', icon: 'success'})
                this.mentorStudents.push(res.data)
            })
            .finally(() => {
                const index = this.mentorStudents.findIndex((mentorStudentAttached) => mentorStudentAttached.id === 0);
                if (index === -1) {
                    return;
                }
                this.mentorStudents.splice(index, 1);
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

    public remove(mentorStudent: IMentorStudent) {
        const index = this.mentorStudents.findIndex(mentorStudentAttached => mentorStudentAttached.id === mentorStudent.id);
        if (index === -1) {
            return;
        }
        this.mentorStudents.splice(index, 1);
        axios.delete(`/webapi/mentor/${mentorStudent.mentor_id}/students/${mentorStudent.student_id}`)
            .then(() => Toast.fire({title: 'Mentor enfernt', icon: 'success'}))
            .catch(() => {
                this.mentorStudents.push(mentorStudent);
            })
    }

    public getMentorByMentorStudent(mentorStudent: IMentorStudent): IMentor {
        const mentor = this.allMentors.find(mentor => mentor.id === mentorStudent.mentor_id)
        return mentor;
    }


}
</script>
