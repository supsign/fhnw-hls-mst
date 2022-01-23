<template>
    <vue-backend-select
        :value="value"
        @input="input"
        :backend-search-url="'/webapi/courses'"
        :disabled="disabled"
        :get-backend-search-params="getCourseSearchParams"
        :label="'Modul'"
        :selectable="courseIsSelectable"
        :show-option="getFullCourseName"
        class="w-full mt-2"
    ></vue-backend-select>
</template>

<script lang="ts">
import {Component, Emit, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {ICourse} from "../../interfaces/course.interface";
import VueBackendSelect from "../form/backendSelect.vue";

@Component({
    components: {VueBackendSelect}
})
export default class VueAdminBackendCourseSelect extends BaseComponent {

    @Prop({type: Boolean, default: false})
    public disabled: boolean;

    @Prop({type: Array, default: (): number[] => []})
    public courseIdsInUse: number[]

    @Prop({type: Object})
    public value: ICourse

    public getCourseSearchParams(search: string) {
        return {search}
    }

    @Emit()
    public input(course: ICourse) {
        return course
    }

    public courseIsSelectable(course: ICourse): boolean {
        return !this.courseIdsInUse.find(id => id === course.id);
    }

    public getFullCourseName(course: ICourse) {
        return course.number + ': ' + course.name;
    }

}
</script>
