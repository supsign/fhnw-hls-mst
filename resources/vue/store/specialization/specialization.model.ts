import { Store } from 'vuex';
import { EntityModel } from '../base/baseEntity.model';
import { IBaseState } from '../base/baseState.interface';
import { ISpecialization } from '../../interfaces/specialization.interface';
import { SpecializationRequestModel } from './specializationRequestModel';

export class SpecializationModel extends EntityModel<
    IBaseState<ISpecialization>,
    typeof SpecializationRequestModel,
    ISpecialization
> {
    constructor(store: Store<IBaseState<ISpecialization>>) {
        super('specialization', store, SpecializationRequestModel);
    }
}
