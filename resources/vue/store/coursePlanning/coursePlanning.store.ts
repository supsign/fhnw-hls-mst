import * as baseGetters from "../base/base.getters";
import * as baseMutations from "../base/base.mutations";
import * as baseActions from "../base/base.actions";
import {state} from "../base/base.state";

export const coursePlanningStore = {
    namespaced: true,
    state,
    getters: {...baseGetters},
    actions: {...baseActions},
    mutations: {...baseMutations}
};
