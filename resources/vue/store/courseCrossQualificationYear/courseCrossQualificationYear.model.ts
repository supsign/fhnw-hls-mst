import {Store} from "vuex";
import {EntityModel} from "../base/baseEntity.model";
import {IBaseState} from "../base/baseState.interface";
import {CourseCrossQualificationYearRequestModel} from "./courseCrossQualificationYearRequestModel";
import {ICourseCrossQualificationYear} from "../../interfaces/courseCrossQualificationYear.interface";


export class CourseCrossQualificationYearModel extends EntityModel<IBaseState<ICourseCrossQualificationYear>,
    typeof CourseCrossQualificationYearRequestModel,
    ICourseCrossQualificationYear> {
    constructor(store: Store<IBaseState<ICourseCrossQualificationYear>>) {
        super("courseCrossQualificationYear", store, CourseCrossQualificationYearRequestModel);
    }
}
