import {IModel} from "../model.interface";

export interface ICoursePlanning extends IModel {
    course_id: number,
    planning_id: number,
    semester_id: number,
}
