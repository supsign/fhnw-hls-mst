import { Store } from 'vuex';
import { EntityModel } from '../base/baseEntity.model';
import { IBaseState } from '../base/baseState.interface';
import { CrossQualificationYearRequestModel } from './crossQualificationYearRequestModel';
import { ICrossQualificationYear } from '../../interfaces/crossQualificationYear.interface';

export class CrossQualificationYearModel extends EntityModel<
    IBaseState<ICrossQualificationYear>,
    typeof CrossQualificationYearRequestModel,
    ICrossQualificationYear
> {
    constructor(store: Store<IBaseState<ICrossQualificationYear>>) {
        super('crossQualificationYear', store, CrossQualificationYearRequestModel);
    }
}
