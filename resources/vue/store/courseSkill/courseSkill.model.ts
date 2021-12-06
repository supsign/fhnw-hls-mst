import {Store} from "vuex";
import {EntityModel} from "../base/baseEntity.model";
import {IBaseState} from "../base/baseState.interface";
import {ICourseSkill} from "./courseSkill.interface";
import {courseSkillRequestModel} from "./courseSkill.requestModel";


export class courseSkillModel extends EntityModel<IBaseState<ICourseSkill>,
    typeof courseSkillRequestModel,
    ICourseSkill> {
    constructor(store: Store<IBaseState<ICourseSkill>>) {
        super("courseSkill", store, courseSkillRequestModel);
    }

    public getByCoursesIds(courseIds: number[]): ICourseSkill[] {
        return this._store.getters[`${this._modelName}/getByCoursesIds`](courseIds);
    }
}
