import {Store} from "vuex";
import {EntityModel} from "../base/baseEntity.model";
import {IBaseState} from "../base/baseState.interface";
import {CourseRecommendationRequestModel} from "./courseRecommendationRequestModel";
import {ICourseRecommendation} from "../../interfaces/courseRecommendation.interface";


export class CourseRecommendationModel extends EntityModel<IBaseState<ICourseRecommendation>,
    typeof CourseRecommendationRequestModel,
    ICourseRecommendation> {
    constructor(store: Store<IBaseState<ICourseRecommendation>>) {
        super("courseRecommendation", store, CourseRecommendationRequestModel);
    }
}
