import {IModel} from "../store/model.interface";

export interface ISpecializationYear extends IModel {
    specialization_id: number;
    study_field_year_id: number;
    assessment_id: number;
    amount_to_pass: number;
}
