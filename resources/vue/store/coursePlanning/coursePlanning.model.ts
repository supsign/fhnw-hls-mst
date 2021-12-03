import {Store} from "vuex";
import {EntityModel} from "../base/baseEntity.model";
import {IBaseState} from "../base/baseState.interface";
import {coursePlanningRequestModel} from "./coursePlanning.requestModel"
import {ICoursePlanning} from "./coursePlanning.interface";


export class CoursePlanningModel extends EntityModel<IBaseState<ICoursePlanning>,
    typeof coursePlanningRequestModel,
    ICoursePlanning> {
    constructor(store: Store<IBaseState<ICoursePlanning>>) {
        super("coursePlanning", store, coursePlanningRequestModel);
    }

    public getCoursePlanning(planningId: number, courseId: number) {
        return this._store.getters[`${this._modelName}/getCoursePlanning`](planningId, courseId);
    }

    public byPlanningId(planningId: number): ICoursePlanning[] {
        return this._store.getters[`${this._modelName}/byPlanningId`](planningId);
    }
}
