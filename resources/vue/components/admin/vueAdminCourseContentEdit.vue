<template>
    <div class="flex flex-col gap-10">
        <div class="flex flex-row mb-2 text-sm lg:text-base">
            <div>
                <div class="w-36 lg:w-60 font-bold">Modul-Nummer</div>
                <div>{{course.number}}</div>
            </div>
            <div>
                <div class="flex-grow font-bold">Name</div>
                <div>{{course.name}}</div>
            </div>

        </div>
        <div>
            <div class="flex-grow font-bold">Credits</div>
            <vue-input type="text" name="credits" v-model="credits" @input="updateCredits"></vue-input>
        </div>
            <div v-for="(courseYear, index) in course.course_years" :key="index">
              <div class="font-bold">{{courseYear.name}}</div>
                <vue-editor v-model="courseYear.contents"
                            name="contents"
                            :id="String(index)"
                            label="Inhalte"
                            @input="debounceUpdateCourseYear(courseYear)"
                >

                </vue-editor>
            </div>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import VueCheckbox from "../form/vueCheckbox.vue";
import VueInput from "../form/vueInput.vue";
import VueEditor from "../form/vueEditor.vue";
import axios from "axios";
import { ICourse } from "../../interfaces/course.interface";
import {ICourseYear} from "../../interfaces/courseYear.interface";

@Component({
    components: {
        VueCheckbox,
        VueInput,
        VueEditor
    }
})

export default class VueAdminCourseEdit extends BaseComponent {
    @Prop({type: Object})
    public course: ICourse

    public credits = 0

    public created() {
        this.credits = this.course.credits
    }
    public updateCredits() {
        axios.patch<ICourse>(`/webapi/courses/${this.course.id}`, {
            credits: this.credits
        });
    }
    public debounce: any = null
    public debounceUpdateCourseYear(courseYear: ICourseYear){
        if(this.debounce !== null) {
            clearTimeout(this.debounce);
            this.debounce = null
        }
        this.debounce = setTimeout(() => {
                this.updateCourseYear(courseYear)
        }, 500);
    }
    public updateCourseYear(courseYear: ICourseYear) {
            axios.patch<ICourse>(`/webapi/courseyears/${courseYear.id}`, {
                contents: courseYear.contents
            });
    }
}
</script>
