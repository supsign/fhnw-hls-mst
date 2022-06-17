import { Store } from 'vuex';
import { EntityModel } from '../base/baseEntity.model';
import { IBaseState } from '../base/baseState.interface';
import { SpecializationYearRequestModel } from './specializationYearRequestModel';
import { ISpecializationYear } from '../../interfaces/specialzationYear.interface';

export class SpecializationYearModel extends EntityModel<
    IBaseState<ISpecializationYear>,
    typeof SpecializationYearRequestModel,
    ISpecializationYear
> {
    constructor(store: Store<IBaseState<ISpecializationYear>>) {
        super('specializationYear', store, SpecializationYearRequestModel);
    }
}
