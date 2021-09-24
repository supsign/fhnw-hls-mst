import "./bootstrap";

import { Vue } from "vue-property-decorator";
import Vuex from "vuex";

Vue.use( Vuex );

const store = new Vuex.Store({
    strict: true,
    modules: {

    },
});

const app = new Vue({
    el: "#app",
    components: {

    },
    store
});
