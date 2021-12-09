import {IModel} from "../store/model.interface"

export interface IPlanning extends IModel {
    cross_qualification_year_id: number
    mentor_id: number
    name: string
    specialization_year_id: number
    student_id: number
    study_field_year_id: number
    is_locked: boolean
}
