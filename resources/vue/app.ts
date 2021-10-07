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
import VuePlanCourse from "./component/planning/vuePlanCourse.vue";

library.add(faUserSecret);
library.add(faCheck);

Vue.component("font-awesome-icon", FontAwesomeIcon);
Vue.use(Vuex);

const store = new Vuex.Store({
    strict: true,
    modules: {},
});

const app = new Vue({
    el: "#app",
    components: {
        VueForm,
        VueInput,
        VueSelect,
        VueCheckbox,
        VuePlanCourse
    },
    store
});
