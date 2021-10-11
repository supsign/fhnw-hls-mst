import { IBaseState } from "./baseState.interface";
import { IModel } from "../model.interface";

export const patch = (state: IBaseState<IModel>, payload: IModel) => {
    const entity = state.entities.local.find(
        entity => entity?.id === payload.id
    );

    if (!entity) {
        return;
    }

    Object.assign(entity, payload);
};

export const patchServerState = (
    state: IBaseState<IModel>,
    payload: IModel
) => {
    const entity = state.entities.server.find(
        entity => entity?.id === payload.id
    );

    if (!entity) {
        return;
    }

    Object.assign(entity, payload);
};

export const add = (state: IBaseState<IModel>, payload: IModel) => {
    if (!payload.id) {
        return;
    }
    const entity = state.entities.local.find(
        entity => entity?.id === payload.id
    );
    if (entity) {
        patch(state, payload);
        patchServerState(state, payload);
        return;
    }
    state.entities.local.push(payload);
    state.entities.server.push({ ...payload });
};

export const initMultiple = (state: IBaseState<IModel>, models: IModel[]) => {
    if (!Array.isArray(models))
        if (state.entities.local.length !== 0) {
            throw Error();
        }
    state.entities.local.length = 0;
    state.entities.server.length = 0;
    state.entities.local.push(...models);
    state.entities.server.push(...models);
};

export const reset = (state: IBaseState<IModel>, id: number) => {
    const entityStateServer = state.entities.server.find(
        entity => entity?.id === id
    );
    if (!entityStateServer) {
        return;
    }

    const entity = state.entities.local.find(entity => entity?.id === id);
    if (!entity) {
        return;
    }

    Object.assign(entity, entityStateServer);
};

export const setEntityIsLoading = (state: IBaseState<IModel>, id: number) => {
    const loadingId = state.isLoading.find(idInLoading => idInLoading === id);

    if (loadingId) {
        return;
    }

    state.isLoading.push(id);
};

export const deleteById = (state: IBaseState<IModel>, id: number) => {
    const localIndex = state.entities.local.findIndex(
        entity => entity.id === id
    );

    state.entities.local.splice(localIndex, 1);
    const serverIndex = state.entities.server.findIndex(
        entity => entity.id === id
    );
    state.entities.server.splice(serverIndex, 1);
};

export const setEntityIsNotLoading = (
    state: IBaseState<IModel>,
    id: number
) => {
    const loadingIdIndex = state.isLoading.findIndex(
        idInLoading => idInLoading === id
    );

    if (loadingIdIndex === -1) {
        return;
    }

    state.isLoading.splice(loadingIdIndex, 1);
};
