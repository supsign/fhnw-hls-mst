import {Store} from "vuex";
import {EntityModel} from "../base/baseEntity.model";
import {IBaseState} from "../base/baseState.interface";
import {ICourse} from "../../interfaces/course.interface";
import {courseRequestModel} from "./course.requestModel";


export class CourseModel extends EntityModel<IBaseState<ICourse>,
    typeof courseRequestModel,
    ICourse> {
    constructor(store: Store<IBaseState<ICourse>>) {
        super("course", store, courseRequestModel);
    }

    public getByAcquisitionSkillIds(skillIds: number[]): ICourse {
        return this._store.getters[`${this._modelName}/getByAcquisitionSkillIds`](skillIds);
    }
}
