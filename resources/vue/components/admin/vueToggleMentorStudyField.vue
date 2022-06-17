<template>
    <tr>
        <td class="text-center mouse-pointer" @click="toggleIsSet">
            <div v-if="isSet">
                <i aria-hidden="true" class="far fa-check-circle"></i>
            </div>
            <div v-else>
                <i aria-hidden="true" class="far fa-circle"></i>
            </div>
        </td>
        <td class="text-center mouse-pointer" @click="toggleIsDeputy">
            <div v-if="isDeputy">
                <i aria-hidden="true" class="far fa-check-circle"></i>
            </div>
            <div v-else>
                <i aria-hidden="true" class="far fa-circle"></i>
            </div>
        </td>
        <td>
            {{ studyField.name }}
        </td>
    </tr>
</template>

<script lang="ts">
import { Component, Prop } from 'vue-property-decorator';
import BaseComponent from '../base/baseComponent';
import { IMentorStudyField } from '../../interfaces/mentorStudyField.interface';
import { IStudyField } from '../../interfaces/studyField.interface';
import axios from 'axios';
import { IMentor } from '../../interfaces/mentor.interface';

@Component
export default class VueToggleMentorStudyField extends BaseComponent {
    @Prop({ type: Object })
    public initMentorStudyField: IMentorStudyField;

    @Prop({ type: Object })
    public mentor: IMentor;

    public mentorStudyField: IMentorStudyField = null;

    @Prop({ type: Object })
    public studyField: IStudyField;

    public isSet = false;

    public isDeputy = false;

    public mounted() {
        if (!this.initMentorStudyField) {
            return;
        }

        this.mentorStudyField = this.initMentorStudyField;

        if (this.initMentorStudyField.is_deputy) {
            this.isDeputy = true;
            return;
        }

        this.isSet = true;
    }

    public toggleIsSet() {
        this.isSet = !this.isSet;

        if (this.isSet) {
            this.isDeputy = false;
        }

        this.saveSettings();
    }

    public toggleIsDeputy() {
        this.isDeputy = !this.isDeputy;

        if (this.isDeputy) {
            this.isSet = false;
        }

        this.saveSettings();
    }

    public saveSettings() {
        if (this.isSet || this.isDeputy) {
            return axios
                .post<IMentorStudyField>('/webapi/mentorStudyFields', {
                    mentor_id: this.mentor.id,
                    study_field_id: this.studyField.id,
                    is_deputy: this.isDeputy,
                })
                .then((res) => {
                    this.mentorStudyField = res.data;
                    this.isDeputy = this.mentorStudyField.is_deputy;
                    this.isSet = !this.mentorStudyField.is_deputy;
                });
        }

        if (this.mentorStudyField) {
            return axios.delete(`/webapi/mentorStudyFields/${this.mentorStudyField.id}`).then(() => {
                this.isSet = false;
                this.isDeputy = false;
                this.mentorStudyField = null;
            });
        }
    }
}
</script>
