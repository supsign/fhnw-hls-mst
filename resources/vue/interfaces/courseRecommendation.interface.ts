import { IModel } from '../store/model.interface';

export interface ICourseRecommendation extends IModel {
    course_id: number;
    planned_semester: number;
    recommendation_id: number;
}
