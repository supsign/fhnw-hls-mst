import {IModel} from "../store/model.interface"

export interface ISpecialization extends IModel {
    name: string
    study_field_id: number
}
