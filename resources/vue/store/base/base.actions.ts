import { ActionContext } from "vuex";

import { IBaseState } from "./baseState.interface";
import { IModel } from "../model.interface";
import { BaseRequestModel } from "../base.requestModel";

export const patch = (
    context: ActionContext<IBaseState<IModel>, any>,
    payload: IModel
) => {
    return context.commit("patch", payload);
};

export const add = (
    context: ActionContext<IBaseState<IModel>, any>,
    payload: IModel
) => {
    return context.commit("add", payload);
};

export const initMultiple = (
    context: ActionContext<IBaseState<IModel>, any>,
    payload: IModel[]
) => {
    return context.commit("initMultiple", payload);
};

export const reset = (
    context: ActionContext<IBaseState<IModel>, any>,
    id: number
) => {
    context.commit("reset", id);
    return context.dispatch("reLoadById", id);
};

export const save = (
    context: ActionContext<IBaseState<IModel>, any>,
    id: number
) => {
    const entity = context.getters.byId(id);

    if (!entity) {
        return null;
    }
    const RequestModel = context.getters.requestModel;
    return RequestModel.patch(entity)
        .then((updatedEntity: any) => {
            context.commit("patch", updatedEntity);
            context.commit("patchServerState", updatedEntity);
        })
        .catch(() => {
            context.commit("reset", id);
            context.dispatch("reLoadById", id);
        });
};

export const post = (
    context: ActionContext<IBaseState<IModel>, any>,
    payload: Partial<IModel>
) => {
    if (payload.id) {
        return null;
    }

    const RequestModel: typeof BaseRequestModel = context.getters.requestModel;
    return RequestModel.post(payload).then(entity => {
        context.commit("add", entity);
        return entity;
    });
};

export const deleteById = (
    context: ActionContext<IBaseState<IModel>, any>,
    id: number
) => {
    return new Promise<void>((resolve, reject) => {
        const entity = context.getters.byId(id);

        if (!entity) {
            reject("Entity not found");
            return;
        }
        const RequestModel: typeof BaseRequestModel =
            context.getters.requestModel;

        RequestModel.delete(id)
            .then(() => {
                context.commit("deleteById", id);
                resolve();
            })
            .catch((res: any) => {
                reject(res ? res.message || res : "");
            });
    });
};

export const loadById = (
    context: ActionContext<IBaseState<IModel>, any>,
    id: number
) => {
    const entityInStore = context.getters.byId(id);
    const isLoading = context.getters.entityIsLoading(id);

    if (entityInStore || isLoading) {
        return;
    }

    const RequestModel = context.getters.requestModel;
    context.commit("setEntityIsLoading", id);
    RequestModel.getById(id).then((entity: any) => {
        context.commit("add", entity);
        context.commit("setEntityIsNotLoading", id);
    });
};

export const reloadById = (
    context: ActionContext<IBaseState<IModel>, any>,
    id: number
) => {
    const entityInStore = context.getters.byId(id);
    const isLoading = context.getters.entityIsLoading(id);

    if (!entityInStore || isLoading) {
        return;
    }

    const RequestModel = context.getters.requestModel;
    context.commit("setEntityIsLoading", id);
    RequestModel.getById(id).then((entity: any) => {
        context.commit("add", entity);
        context.commit("setEntityIsNotLoading", id);
    });
};

export const reLoadById = (
    context: ActionContext<IBaseState<IModel>, any>,
    id: number
) => {
    const RequestModel = context.getters.requestModel;
    RequestModel.getById(id).then((entity: any) => {
        context.commit("patch", entity);
        context.commit("patchServerState", entity);
    });
};
