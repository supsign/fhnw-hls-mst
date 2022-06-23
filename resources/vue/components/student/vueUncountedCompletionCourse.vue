<template>
    <div class="mb-4">
        <div class="flex">
            <div class="w-8">
                <div class="my-auto text-lg flex-none">
                    <i class="far fa-check-circle" aria-hidden="true"></i>
                </div>
            </div>
            <div>
                {{completion.course_year.course.name}}
            </div>
            <div class="w-8">
                <div   class="my-auto text-lg flex-none cursor-pointer" @click.stop="openPicker">
                    <i class="fas fa-link" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <vue-uncounted-completion-course-picker v-if="pickerIsOpen" :student="student" :completion="completion" :course-groups="courseGroups" />
    </div>

</template>

<script lang="ts">

import {Component, Emit, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {IStudent} from "../../interfaces/student.interface";
import {ICourse} from "../../interfaces/course.interface";
import VueUncountedCompletionCoursePicker from "./vueUncountedCompletionCoursePicker.vue";
import {ISemester} from "../../interfaces/semester.interface";
import {ICourseGroup} from "../../store/courseGroup/courseGroup.interface";
import {ICompletion} from "../../interfaces/completion.interface";

@Component({
    components: {VueUncountedCompletionCoursePicker}
})
export default class VueUncountedCompletionCourse extends BaseComponent {
    @Prop({ type: Object })
    public student: IStudent;

    @Prop({ type: Object })
    public completion: ICompletion;

    @Prop({ type: Array })
    public courseGroups: ICourseGroup[];

    public pickerIsOpen = false;

    public openPicker() {
        this.pickerIsOpen = true;
    }
    @Emit()
    public cancel() {
        return;
    }

    public select(semester: ISemester) {
        this.$emit('select', semester);
    }

    public remove(semester: ISemester) {
        if (!semester) {
            return;
        }
        this.$emit('remove');
    }
}
</script>
