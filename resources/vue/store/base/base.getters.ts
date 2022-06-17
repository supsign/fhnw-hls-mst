import { IBaseState } from './baseState.interface';
import { IModel } from '../model.interface';

export const byId =
    (state: IBaseState<IModel>) =>
    (id: number): IModel => {
        return state.entities.local.find((entity) => entity?.id === id);
    };

export const all = (state: IBaseState<IModel>) => {
    // return new Array to prevent unintended change in store
    return [...state.entities.local];
};

export const filter =
    (state: IBaseState<IModel>) =>
    (filter: (value: IModel, index: number, array: IModel[]) => unknown): Array<IModel> => {
        return state.entities.local.filter(filter);
    };

export const entityIsLoading =
    (state: IBaseState<IModel>) =>
    (id: number): boolean => {
        const loadingId = state.isLoading.find((idInLoading) => idInLoading === id);
        return !!loadingId;
    };
