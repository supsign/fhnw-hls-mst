import {Store} from "vuex";
import {EntityModel} from "../base/baseEntity.model";
import {IBaseState} from "../base/baseState.interface";
import {ISkill} from "../../interfaces/skill.interface";
import {skillRequestModel} from "./skill.requestModel";


export class SkillModel extends EntityModel<IBaseState<ISkill>,
    typeof skillRequestModel,
    ISkill> {
    constructor(store: Store<IBaseState<ISkill>>) {
        super("coursePlanning", store, skillRequestModel);
    }
}
