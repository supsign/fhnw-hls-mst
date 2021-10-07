import { IBaseState } from "./baseState.interface";
import { IModel } from "../model.interface";

export const state = (): IBaseState<IModel> => {
  return {
    entities: {
      local: [],
      server: []
    },
    isLoading: [],
    isPatching: []
  };
};
