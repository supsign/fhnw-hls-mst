import {Store} from "vuex";
import {IModel} from "../model.interface";

export class EntityModel<S, T, U extends IModel> {
    protected _modelName: string;
    protected _store: Store<S>;

    public constructor(modelName: string, store: Store<S>, RequestModel: T) {
        this._store = store;
        this._modelName = modelName;
        this._Request = RequestModel;
    }

    protected _Request: T;

    public get Request(): T {
        return this._Request;
    }

    public get all(): U[] {
        return this._store.getters[`${this._modelName}/all`];
    }

    public filter(
        predicate: (value: U, index: number, array: U[]) => unknown
    ): U {
        return this._store.getters[`${this._modelName}/filter`](predicate);
    }

    public getById(id: number): U {
        return this._store.getters[`${this._modelName}/byId`](id);
    }

    public patch(payload: Partial<U>): Promise<void> {
        return this._store.dispatch(`${this._modelName}/patch`, payload);
    }

    public patchById(id: number, payload: Partial<U>): Promise<void> {
        return this._store.dispatch(`${this._modelName}/patch`, {
            id,
            ...payload
        });
    }

    public reset(id: number) {
        return this._store.dispatch(`${this._modelName}/reset`, id);
    }

    public save(id: number): Promise<void> {
        return this._store.dispatch(`${this._modelName}/save`, id);
    }

    public loadById(id: number): Promise<void> {
        return this._store.dispatch(`${this._modelName}/loadById`, id);
    }

    public reloadById(id: number): Promise<void> {
        return this._store.dispatch(`${this._modelName}/reloadById`, id);
    }

    public delete(id: number): Promise<void> {
        return this._store.dispatch(`${this._modelName}/deleteById`, id);
    }

    public post(entity: Partial<U>): Promise<U> {
        return this._store.dispatch(`${this._modelName}/post`, entity);
    }
}
