import { Store } from 'vuex';
import { EntityModel } from '../base/baseEntity.model';
import { IBaseState } from '../base/baseState.interface';
import { AssessmentRequestModel } from './assessmentRequestModel';
import { IAssessment } from '../../interfaces/assessment.interface';

export class AssessmentModel extends EntityModel<IBaseState<IAssessment>, typeof AssessmentRequestModel, IAssessment> {
    constructor(store: Store<IBaseState<IAssessment>>) {
        super('assessment', store, AssessmentRequestModel);
    }
}
