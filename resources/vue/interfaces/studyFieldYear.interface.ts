import {IModel} from "../store/model.interface"

export interface IStudyFieldYear extends IModel {
    assessment_id?: number
    recommendation_id?: number
    begin_semester_id: number
    evento_id: number
    evento_number: string
    is_specialization_mandatory: boolean
    origin_study_field_year_id: number
    study_field_id: number
}
