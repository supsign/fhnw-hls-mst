import { Store } from 'vuex';
import { EntityModel } from '../base/baseEntity.model';
import { IBaseState } from '../base/baseState.interface';
import { AssessmentCourseRequestModel } from './assessmentCourseRequestModel';
import { IAssessmentCourse } from '../../interfaces/assessmentCourse.interface';

export class AssessmentCourseModel extends EntityModel<
    IBaseState<IAssessmentCourse>,
    typeof AssessmentCourseRequestModel,
    IAssessmentCourse
> {
    constructor(store: Store<IBaseState<IAssessmentCourse>>) {
        super('assessmentCourse', store, AssessmentCourseRequestModel);
    }
}
