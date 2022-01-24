import {Store} from "vuex";
import {EntityModel} from "../base/baseEntity.model";
import {IBaseState} from "../base/baseState.interface";
import {CourseGroupYearRequestModel} from "./courseGroupYearRequestModel";
import {ICourseGroupYear} from "../../interfaces/courseGroupYear.interface";


export class CourseGroupYearModel extends EntityModel<IBaseState<ICourseGroupYear>,
    typeof CourseGroupYearRequestModel,
    ICourseGroupYear> {
    constructor(store: Store<IBaseState<ICourseGroupYear>>) {
        super("courseGroupYear", store, CourseGroupYearRequestModel);
    }
}
