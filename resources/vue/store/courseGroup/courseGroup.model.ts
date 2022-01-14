import {Store} from "vuex";
import {EntityModel} from "../base/baseEntity.model";
import {IBaseState} from "../base/baseState.interface";
import {CourseGroupRequestModel} from "./courseGroupRequestModel";
import {ICourseGroup} from "./courseGroup.interface";


export class CourseGroupModel extends EntityModel<IBaseState<ICourseGroup>,
    typeof CourseGroupRequestModel,
    ICourseGroup> {
    constructor(store: Store<IBaseState<ICourseGroup>>) {
        super("courseGroup", store, CourseGroupRequestModel);
    }
}
