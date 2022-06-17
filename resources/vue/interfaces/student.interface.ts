import { IModel } from '../store/model.interface';

export interface IStudent extends IModel {
    created_at: number;
    study_field_year_id: number;
}
