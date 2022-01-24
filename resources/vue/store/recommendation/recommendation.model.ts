import {Store} from "vuex";
import {EntityModel} from "../base/baseEntity.model";
import {IBaseState} from "../base/baseState.interface";
import {RecommendationRequestModel} from "./recommendationRequestModel";
import {IRecommendation} from "./recommendation.interface";


export class RecommendationModel extends EntityModel<IBaseState<IRecommendation>,
    typeof RecommendationRequestModel,
    IRecommendation> {
    constructor(store: Store<IBaseState<IRecommendation>>) {
        super("recommendation", store, RecommendationRequestModel);
    }
}
