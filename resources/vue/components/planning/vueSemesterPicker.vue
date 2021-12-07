<template>
  <div aria-labelledby="modal-title" aria-modal="true" class="fixed z-10 inset-0 overflow-y-auto" role="dialog"
       @click.stop="cancel">
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
                    <div class="grid grid-cols-2 gap-4 flex lg:flex-none sm:items-start">
                        <div class="col-start-1 col-end-1 text-center font-bold">Frühlinssemester</div>
                        <div class="col-start-2 col-end-2 text-center font-bold">Herbstsemester</div>
                        <div v-for="semester in pickableSemsters"
                             :class="{'bg-gray-300': semesterIsSelected(semester), 'col-start-1 col-end-1 ': !semester.is_hs, 'col-start-2 col-end-2': semester.is_hs }"
                             class="bg-gray-100 w-full h-8 text-center leading-loose cursor-pointer"
                             @click.stop="()=>select(semester)">
                            <div v-if="semesterIsSelected(semester) && isSaving"
                                 class="w-36 mx-auto text-center text-xl">
                                <i aria-hidden="true"
                                   class="fad fa-circle-notch fa-spin"
                                ></i>
                            </div>
                            <div v-else class="flex justify-between mx-4 h-full">
                                <div class="text-center my-auto w-full">
                                    {{ semester.year }} {{ getShortHS(semester) }}
                                </div>
                                <span v-if="semesterIsSelected(semester)"
                                      class="my-auto"
                                      @click.stop="remove(semester)"
                                >
                                        <i
                                            aria-hidden="true" class="fas fa-trash text-red-600 my-auto"></i>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Emit, Prop, Watch} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ISemester} from "../../interfaces/semester.interface";
import {ICourse} from "../../interfaces/course.interface";

@Component
export default class VueSemesterPicker extends BaseComponent {
    @Prop({
        type: Array
    })
    public semesters: ISemester[];

    @Prop({type: Object})
    public selectedSemester: ISemester

    @Prop({type: Boolean, default: false})
    public isSaving: boolean;

    @Prop({type: Object})
    public course: ICourse

    public intSelectedSemester: ISemester = null;

    @Emit()
    public cancel() {
        return;
    }

    public getShortHS(semester: any) {
        return semester.is_hs ? 'HS' : 'FS'
    }

    @Watch('selectedSemester')
    public initIntSelectedSemester(semester: ISemester) {
        this.intSelectedSemester = semester;
    }

    public select(semester: ISemester) {
        if (this.isSaving) {
            return;
        }
        this.intSelectedSemester = semester;
        this.$emit('select', semester);
    }

    public remove(semester: ISemester) {
        if (this.isSaving) {
            return;
        }

        this.intSelectedSemester = semester;
        this.$emit('remove');
    }

    public semesterIsSelected(semester: ISemester) {
        if (!semester) {
            return false
        }

        if (this.intSelectedSemester) {
            return this.intSelectedSemester.id === semester.id
        }

        if (this.selectedSemester) {
            return this.selectedSemester.id === semester.id;
        }

        return false
    }

    public get pickableSemsters(): ISemester[] {
        return this.semesters.filter((semester) => {
            const now = new Date();
            if (typeof semester.start_date === 'string') {
                semester.start_date = new Date(semester.start_date);
            }

            return semester.start_date.getTime() > now.getTime();
        }).filter((semester) => {
            return (semester.is_hs && this.course.is_hs) || (!semester.is_hs && this.course.is_fs)
        })
    }
}
</script>

