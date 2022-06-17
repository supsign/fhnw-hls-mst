import { Store } from 'vuex';
import { EntityModel } from '../base/baseEntity.model';
import { IBaseState } from '../base/baseState.interface';
import { IStudyField } from '../../interfaces/studyField.interface';
import { StudyFieldRequestModel } from './studyFieldRequestModel';

export class StudyFieldModel extends EntityModel<IBaseState<IStudyField>, typeof StudyFieldRequestModel, IStudyField> {
    constructor(store: Store<IBaseState<IStudyField>>) {
        super('studyField', store, StudyFieldRequestModel);
    }
}
