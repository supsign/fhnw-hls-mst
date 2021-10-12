import {IModel} from "../store/model.interface";

export interface ICourse extends IModel {
    course_type_id: number
    credits: number
    language_id: number
    name?: string
    number: string
    study_field_id?: number
}
