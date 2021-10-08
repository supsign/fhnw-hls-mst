import {IBaseState} from "../base/baseState.interface";
import {ICoursePlanning} from "./coursePlanning.interface";

export const getCoursePlanning = (state: IBaseState<ICoursePlanning>) =>
    (planningId: number, courseId:number): ICoursePlanning|null => {
        return state.entities.local.find(entity => entity.course_id === courseId && entity.planning_id === planningId);
    };
