import {Store} from "vuex";
import {EntityModel} from "../base/baseEntity.model";
import {IBaseState} from "../base/baseState.interface";

import {IAssessment} from "../../interfaces/assessment.interface";
import {RecommendationRequestModel} from "./recommendationRequestModel";


export class RecommendationModel extends EntityModel<IBaseState<IAssessment>,
    typeof RecommendationRequestModel,
    IAssessment> {
    constructor(store: Store<IBaseState<IAssessment>>) {
        super("recommendation", store, RecommendationRequestModel);
    }
}
