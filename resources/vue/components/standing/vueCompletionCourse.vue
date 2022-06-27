<template>
    <div class="mb-4">
        <div class="flex gap-3">
            <div>
                <div class="my-auto text-lg flex-none">
                    <i class="far fa-check-circle" aria-hidden="true"></i>
                </div>
            </div>
            <div>
                {{ completion.course_year.course.name }}
            </div>
            <div>
                <div class="my-auto text-lg flex-none cursor-pointer" @click.stop="remove()">
                    <i class="far fa-times" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
</template>
<script lang="ts">
import { Component, Prop } from 'vue-property-decorator';
import BaseComponent from '../base/baseComponent';
import { IStudent } from '../../interfaces/student.interface';
import { ICompletion } from '../../interfaces/completion.interface';
import { ICourse } from '../../interfaces/course.interface';
import { ICourseGroup } from '../../store/courseGroup/courseGroup.interface';
import axios from 'axios';

@Component({})
export default class VueStandingCourse extends BaseComponent {
    @Prop({ type: Object })
    public student: IStudent;

    @Prop({ type: Object })
    public completion: ICompletion;

    public async remove() {
        try {
            await axios.post(`/webapi/completions/${this.completion.id}/addtocoursegroup`, {});
            window.location.reload();
        } catch (error) {}
    }
}
</script>
