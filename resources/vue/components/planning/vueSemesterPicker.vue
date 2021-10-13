<template>
    <div aria-labelledby="modal-title" aria-modal="true" class="fixed z-10 inset-0 overflow-y-auto" role="dialog"
         @click="cancel">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!--
              Background overlay, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div aria-hidden="true" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span aria-hidden="true" class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <!--
              Modal panel, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all w-full sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div v-for="semester in semesters" class="border border-black w-full h-8 text-center"
                             @click="()=>select(semester)">
                            {{ semester.year }} {{ getShortHS(semester) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Emit, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";

@Component
export default class VueSemesterPicker extends BaseComponent {
    @Prop({
        type: Array
    })
    public semesters: any[];

    @Emit()
    public cancel() {
        return;
    }

    public getShortHS(semester: any) {
        return semester.is_hs ? 'HS' : 'FS'
    }

    @Emit()
    public select(semester: any) {
        return semester;
    }
}
</script>

