import { Store } from 'vuex';
import { EntityModel } from '../base/baseEntity.model';
import { IBaseState } from '../base/baseState.interface';
import { CourseCourseGroupYearRequestModel } from './courseCourseGroupYearRequestModel';
import { ICourseCourseGroupYear } from './courseCourseGroupYear.interface';

export class CourseCourseGroupYearModel extends EntityModel<
    IBaseState<ICourseCourseGroupYear>,
    typeof CourseCourseGroupYearRequestModel,
    ICourseCourseGroupYear
> {
    constructor(store: Store<IBaseState<ICourseCourseGroupYear>>) {
        super('courseCourseGroupYear', store, CourseCourseGroupYearRequestModel);
    }
}
