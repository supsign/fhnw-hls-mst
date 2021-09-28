import "./bootstrap";

import { Vue } from "vue-property-decorator";
import Vuex from "vuex";

import VueForm from "./components/form/vueForm.vue";

Vue.use( Vuex );

const store = new Vuex.Store({
    strict: true,
    modules: {

    },
});

const app = new Vue({
    el: "#app",
    components: {
        VueForm,
    },
    store
});
