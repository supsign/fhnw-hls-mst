import "./bootstrap";

import {Vue} from "vue-property-decorator";
import Vuex from "vuex";

import {library} from "@fortawesome/fontawesome-svg-core";
import {faCheck, faUserSecret} from "@fortawesome/free-solid-svg-icons";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

import VueForm from "./components/form/vueForm.vue";
import VueInput from "./components/form/vueInput.vue";
import VueSelect from "./components/form/vueSelect.vue";
import VueCheckbox from "./components/form/vueCheckbox.vue";
import VuePlanCourse from "./components/planning/vuePlanCourse.vue";
import {coursePlanningStore} from "./store/coursePlanning/coursePlanning.store";
import VueStoreFill from "./components/store/vueStoreFill.vue"
import VueCourseGroupState from "./components/planning/vueCourseGroupState.vue";
import VuePlanWrapper from "./components/planning/vuePlanWrapper.vue";
import VueStateWrapper from "./components/Assessment/VueStateWrapper.vue";
import VueShowAndSelectMentors from "./components/mentor/VueShowAndSelectMentors.vue";
import VueAssessmentState from "./components/Assessment/VueAssessmentState.vue";
import VueCreatePlanningForm from "./components/planning/vueCreatePlanningForm.vue";
import VueAdminCourseEdit from "./components/admin/vueAdminCourseEdit.vue";
import VuePlanningSemester from "./components/planning/vuePlanningSemester.vue";
import VueCourseDetail from "./components/planning/vueCourseDetail.vue";
import {courseStore} from "./store/course/course.store";
import {semesterStore} from "./store/semester/semester.store";
import {skillStore} from "./store/skill/skill.store";
import {skillStudentStore} from "./store/skillStudent/skillStudent.store";
import {courseSkillStore} from "./store/courseSkill/courseSkill.store";
import VueSessionSweetalert from "./components/base/vueSessionSweetalert.vue";
import VueAdminMentorStudyFields from "./components/admin/vueAdminMentorStudyFields.vue";
import VueLockPlanning from "./components/planning/vueLockPlanning.vue";
import VueAdminMentorStudents from "./components/admin/vueAdminMentorStudents.vue";
import VueAdminCourseCrossQualificationYear from "./components/admin/vueAdminCourseCrossQualificationYear.vue"

//@ts-ignore
import VueMask from 'v-mask'
import VueAdminCrossQualificationYear from "./components/admin/vueAdminCrossQualificationYear.vue";
import VueAdminFaqWrapper from "./components/admin/vueAdminFaqWrapper.vue";
import VueEditor from "./components/form/vueEditor.vue";
// @ts-ignore
import Editor from "@tinymce/tinymce-vue";

library.add(faUserSecret);
library.add(faCheck);

Vue.component("font-awesome-icon", FontAwesomeIcon);
Vue.component( "editor", Editor );
Vue.use(Vuex);
Vue.use(VueMask);

const store = new Vuex.Store({
    strict: true,
    modules: {
        coursePlanning: coursePlanningStore,
        course: courseStore,
        semester: semesterStore,
        skill: skillStore,
        skillStudent: skillStudentStore,
        courseSkill: courseSkillStore
    },
});

const app = new Vue({
    el: "#app",
    components: {
        VueForm,
        VueInput,
        VueSelect,
        VueCheckbox,
        VuePlanCourse,
        VueStoreFill,
        VueCourseGroupState,
        VuePlanWrapper,
        VueStateWrapper,
        VueAssessmentState,
        VueCreatePlanningForm,
        VueShowAndSelectMentors,
        VueAdminCourseEdit,
        VueCourseDetail,
        VuePlanningSemester,
        VueSessionSweetalert,
        VueAdminMentorStudyFields,
        VueLockPlanning,
        VueAdminMentorStudents,
        VueAdminCourseCrossQualificationYear,
        VueAdminCrossQualificationYear,
        VueAdminFaqWrapper,
        VueEditor
    },
    store
});
