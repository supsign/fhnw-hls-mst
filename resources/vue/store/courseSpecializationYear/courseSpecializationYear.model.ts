import {Store} from "vuex";
import {EntityModel} from "../base/baseEntity.model";
import {IBaseState} from "../base/baseState.interface";
import {CourseSpecializationYearRequestModel} from "./courseSpecializationYearRequestModel";
import {ICourseSpecializationYear} from "./courseSpecializationYear.interface";


export class CourseSpecializationYearModel extends EntityModel<IBaseState<ICourseSpecializationYear>,
    typeof CourseSpecializationYearRequestModel,
    ICourseSpecializationYear> {
    constructor(store: Store<IBaseState<ICourseSpecializationYear>>) {
        super("courseSpecializationYear", store, CourseSpecializationYearRequestModel);
    }
}
