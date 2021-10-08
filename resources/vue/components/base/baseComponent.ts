import Vue from "vue";
import Component from "vue-class-component";
import {CoursePlanningModel} from "../../store/coursePlanning/coursePlanning.model";

// Define a super class component
@Component
export default class BaseComponent extends Vue {
    public models = {
        coursePlanning: new CoursePlanningModel(this.$store)
    }

}
