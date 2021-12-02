import {Store} from "vuex";
import {EntityModel} from "../base/baseEntity.model";
import {IBaseState} from "../base/baseState.interface";
import {ISkillStudent} from "./skillStudent.interface";
import {skillStudentRequestModel} from "./skillStudent.requestModel";


export class SkillStudentModel extends EntityModel<IBaseState<ISkillStudent>,
    typeof skillStudentRequestModel,
    ISkillStudent> {
    constructor(store: Store<IBaseState<ISkillStudent>>) {
        super("coursePlanning", store, skillStudentRequestModel);
    }
}
