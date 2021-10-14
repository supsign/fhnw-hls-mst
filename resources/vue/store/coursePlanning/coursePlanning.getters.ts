import {IBaseState} from "../base/baseState.interface";
import {ICoursePlanning} from "./coursePlanning.interface";
import {coursePlanningRequestModel} from "./coursePlanning.requestModel";

export const getCoursePlanning = (state: IBaseState<ICoursePlanning>) =>
    (planningId: number, courseId: number): ICoursePlanning | null => {
        return state.entities.local.find(entity => entity.course_id === courseId && entity.planning_id === planningId);
    };

export const requestModel = (): typeof coursePlanningRequestModel => {
    return coursePlanningRequestModel;
};
