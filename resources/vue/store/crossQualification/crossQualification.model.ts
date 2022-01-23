import {Store} from "vuex";
import {EntityModel} from "../base/baseEntity.model";
import {IBaseState} from "../base/baseState.interface";
import {CrossQualificationRequestModel} from "./crossQualificationRequestModel";
import {ICrossQualification} from "../../interfaces/crossQualification.interface";


export class CrossQualificationModel extends EntityModel<IBaseState<ICrossQualification>,
    typeof CrossQualificationRequestModel,
    ICrossQualification> {
    constructor(store: Store<IBaseState<ICrossQualification>>) {
        super("crossQualification", store, CrossQualificationRequestModel);
    }
}
