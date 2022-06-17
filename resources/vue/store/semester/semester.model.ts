import { Store } from 'vuex';
import { EntityModel } from '../base/baseEntity.model';
import { IBaseState } from '../base/baseState.interface';
import { ISemester } from '../../interfaces/semester.interface';
import { semesterRequestModel } from './semester.requestModel';

export class SemesterModel extends EntityModel<IBaseState<ISemester>, typeof semesterRequestModel, ISemester> {
    constructor(store: Store<IBaseState<ISemester>>) {
        super('semester', store, semesterRequestModel);
    }
}
