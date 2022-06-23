<template>
    <div
        tabindex="0"
        aria-labelledby="modal-title"
        aria-modal="true"
        class="fixed z-10 inset-0 overflow-y-auto"
        role="dialog"
        @click.stop="cancel"
        @keydown.esc="cancel"
        ref="modal"
    >
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div aria-hidden="true" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <span aria-hidden="true" class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div
                @click.stop="() => {}"
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all w-full sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            >
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div>
                        <div class="text-center text-lg mb-5">Modulgruppe auswählen</div>
                        <div class="grid grid-cols-1 gap-4 lg:flex-none sm:items-start">
                            <button v-for="(courseGroup, index) in courseGroups" :key="index"
                                class="bg-gray-100 w-full h-8 text-center leading-loose cursor-pointer"
                                @click.stop="() => save(courseGroup)"
                            >
                                <div class="flex justify-between mx-4 h-full">
                                    <div class="text-center my-auto w-full">
                                        {{ courseGroup.name }}
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { Component, Emit, Prop, Watch } from 'vue-property-decorator';
import BaseComponent from '../base/baseComponent';
import {IStudent} from "../../interfaces/student.interface";
import {ICourseGroup} from "../../store/courseGroup/courseGroup.interface";
import VueForm from "../form/vueForm.vue";
import {ICompletion} from "../../interfaces/completion.interface";
import axios from "axios";

@Component({
    components: {VueForm}
})
export default class VueSemesterPicker extends BaseComponent {

    @Prop({ type: Object })
    public student: IStudent;


    @Prop({ type: Object })
    public completion: ICompletion;

    @Prop({ type: Array })
    public courseGroups: ICourseGroup[];


    @Emit()
    public cancel() {
        return;
    }

    public save(courseGroup: ICourseGroup) {
        axios.post(`/webapi/completions/${this.completion.id}/addtocoursegroup`,{course_group_id: courseGroup.id})
    }

    public mounted() {
        // @ts-ignore
        this.$refs.modal.focus();
    }
}
</script>
