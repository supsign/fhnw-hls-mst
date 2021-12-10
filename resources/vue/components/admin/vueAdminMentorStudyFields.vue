<template>
    <div class="p-2 rounded  bg-white flex flex-col shadow-xl">
        <div class="content-center p-2 border-b rounded-t text-base md:text-lg">
            <div>Studiengänge</div>
        </div>

        <div class="p-3 text-sm md:text-base flex-grow">
            <table class="table-auto">
                <thead>
                <tr class="text-left">
                    <th class="w-16">Leitung</th>
                    <th class="w-16">Stv.</th>
                    <th>Studiengang</th>
                </tr>
                </thead>
                <tbody>
                <vue-toggle-mentor-study-field v-for="studyField in orderedStudyFields"
                                               :key="studyField.id"
                                               :initMentorStudyField="getMentorStudyField(studyField)"
                                               :mentor="mentor"
                                               :studyField="studyField"
                >
                </vue-toggle-mentor-study-field>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {IStudyField} from "../../interfaces/studyField.interface";
import {IMentorStudyField} from "../../interfaces/mentorStudyField.interface";
import VueToggleMentorStudyField from "./vueToggleMentorStudyField.vue";
import {IMentor} from "../../interfaces/mentor.interface";

@Component({
    components: {VueToggleMentorStudyField}
})
export default class VueAdminMentorStudyFields extends BaseComponent {

    @Prop({type: Array})
    public studyFields: IStudyField[]

    @Prop({type: Array})
    public mentorStudyFields: IMentorStudyField[]

    @Prop({type: Object})
    public mentor: IMentor

    public get orderedStudyFields(): IStudyField[] {
        if (!this.studyFields) {
            return []
        }

        return this.studyFields.sort((a, b) => a.name.localeCompare(b.name))
    }

    public getMentorStudyField(studyField: IStudyField): IMentorStudyField {
        return this.mentorStudyFields.find(mentorStudyField => mentorStudyField.study_field_id === studyField.id)
    }

}
</script>
