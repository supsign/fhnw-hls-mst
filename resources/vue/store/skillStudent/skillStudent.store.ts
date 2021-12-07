import * as baseGetters from "../base/base.getters";
import * as baseMutations from "../base/base.mutations";
import * as baseActions from "../base/base.actions";
import * as getters from "./skillStudent.getters";
import {state} from "../base/base.state";

export const skillStudentStore = {
    namespaced: true,
    state,
    getters: {...baseGetters, ...getters},
    actions: {...baseActions},
    mutations: {...baseMutations}
};
