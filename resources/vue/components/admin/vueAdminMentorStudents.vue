<template>
    <div class="p-2 rounded  bg-white flex flex-col shadow-xl">
        <div class="content-center p-2 border-b rounded-t text-base md:text-lg" v>
            <div>Studierende</div>
        </div>

        <div class="p-3 text-sm md:text-base flex-grow">
            <div v-for="mentorStudent in mentorStudents">
                {{ mentorStudent.firstname }} {{ mentorStudent.lastname }}
            </div>
            <div class="flex flex-row space-x-2 mt-4">
                <vue-input v-model="eventoId" :disabled="inputIsDisabled" :label="'Evento-ID'" required></vue-input>
                <vue-input v-model="firstname" :disabled="inputIsDisabled" :label="'Vorname'" required></vue-input>
                <vue-input v-model="lastname" :disabled="inputIsDisabled" :label="'Nachname'" required></vue-input>
                <div class="flex flex-col justify-end">
                    <button class="button-primary" @click="addStudent">Hinzufügen</button>
                </div>
            </div>

        </div>

    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {IMentor} from "../../interfaces/mentor.interface";
import {IMentorStudent} from "../../interfaces/mentorStudent.interface";
import VueInput from "../form/vueInput.vue";
import axios from "axios";
import {Toast} from "../../helpers/toast";

@Component({
    components: {VueInput}
})
export default class VueAdminMentorStudents extends BaseComponent {

    @Prop({type: Object})
    public mentor: IMentor

    @Prop({type: Array})
    public initMentorStudents: IMentorStudent[]

    public mentorStudents: IMentorStudent[] = [];

    public eventoId: number = null;

    public firstname: string = null;

    public lastname: string = null;

    public inputIsDisabled = false;

    public created() {
        this.mentorStudents = this.initMentorStudents;
    }

    public addStudent() {
        axios.post<IMentorStudent>(`/webapi/mentor/${this.mentor.id}/students`, {
            evento_id: this.eventoId,
            firstname: this.firstname,
            lastname: this.lastname
        })
            .then((res) => {
                Toast.fire({title: 'Mentor hinzugefügt', icon: 'success'})
                this.mentorStudents.push(res.data);
                this.resetInput()
            })
            .catch((reason) => {
                Toast.fire({title: 'Error', icon: 'success', text: reason.text});
                console.log(reason);
                this.eventoId = null;
            })
    }

    public resetInput() {
        this.eventoId = null;
        this.firstname = null;
        this.lastname = null;
    }


}
</script>
