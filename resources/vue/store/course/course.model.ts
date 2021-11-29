import {Store} from "vuex";
import {EntityModel} from "../base/baseEntity.model";
import {IBaseState} from "../base/baseState.interface";
import {ICourse} from "../../interfaces/course.interface";
import {courseRequestModel} from "./course.requestModel";


export class CourseModel extends EntityModel<IBaseState<ICourse>,
    typeof courseRequestModel,
    ICourse> {
    constructor(store: Store<IBaseState<ICourse>>) {
        super("coursePlanning", store, courseRequestModel);
    }
}
