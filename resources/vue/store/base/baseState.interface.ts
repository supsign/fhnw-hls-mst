import { IModel } from "../model.interface";

export interface IBaseState<T extends IModel> {
  entities: {
    local: Array<T>;
    server: Array<T>;
  };
  isLoading: Array<number>;
  isPatching: Array<number>;
}
