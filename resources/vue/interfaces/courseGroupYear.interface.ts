import {IModel} from "../store/model.interface"

export interface ICourseGroupYear extends IModel {
    amount_to_pass?: number
    course_group_id: number
    credits_to_pass?: number
    study_field_year_id: number
}
