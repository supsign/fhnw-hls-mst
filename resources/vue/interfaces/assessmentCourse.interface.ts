import {IModel} from "../store/model.interface";

export interface IAssessmentCourse extends IModel {
    course_id: number,
    assessment_id: number
}
