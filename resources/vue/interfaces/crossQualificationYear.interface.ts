import {IModel} from "../store/model.interface";

export interface ICrossQualificationYear extends IModel {
    cross_qualification_id: number;
    study_field_year_id: number;
    assessment_id: number;
    amount_to_pass: number;
}
