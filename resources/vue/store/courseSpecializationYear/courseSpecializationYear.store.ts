import * as baseGetters from "../base/base.getters";
import * as baseMutations from "../base/base.mutations";
import * as baseActions from "../base/base.actions";
import * as getters from "./courseSpecializationYear.getters";
import {state} from "../base/base.state";

export const courseSpecializationYearStore = {
    namespaced: true,
    state,
    getters: {...baseGetters, ...getters},
    actions: {...baseActions},
    mutations: {...baseMutations}
};
