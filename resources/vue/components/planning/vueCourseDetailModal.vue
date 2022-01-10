<template>
    <div tabindex="0" aria-labelledby="modal-title" aria-modal="true" class="fixed z-10 inset-0 overflow-y-auto" role="dialog"
         @click.stop="cancel"
         @keydown.esc="cancel"
         ref="modal"
    >
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

            <div aria-hidden="true" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <span aria-hidden="true" class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div
                @click.stop="()=>{}"
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all w-full sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="p-4">
                    <div class="flex flex-row justify-between">
                        <div class="text-gray-500 text-xl mb-4">
                            {{ courseYear.name }}
                        </div>
                        <div @click.stop="cancel" class="cursor-pointer">
                            <i class="far fa-times-circle" aria-hidden="true"></i>
                        </div>
                    </div>

                    <div class="sourceHtml mb-8" v-html="courseYear.contents">
                    </div>

                    <div v-if="!courseIsSuccessfullyCompleted">
                        <div v-if="missingCourses.length > 0 || !isPlaned" class="font-bold">Fehlende Kurse</div>
                        <div v-if="!isPlaned"> Bitte planen Sie zuerst das Modul ein.</div>
                        <ul v-else class="list-disc list-outside ml-4">
                            <li v-for="missingCourse in missingCourses">{{ missingCourse.name }}</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Emit, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ICourse} from "../../interfaces/course.interface";

@Component
export default class VueCourseDetailModal extends BaseComponent {

    @Prop({type: Object})
    course: ICourse

    @Prop({type: Object})
    courseYear: ICourse

    @Prop({type: Array})
    missingCourses: ICourse[]

    @Prop({type: Boolean})
    isPlaned: boolean

    @Prop({type: Boolean})
    courseIsSuccessfullyCompleted: boolean;


    @Emit()
    public cancel() {
        return;
    }

    public mounted() {
        // @ts-ignore
        this.$refs.modal.focus();
    }

}
</script>


