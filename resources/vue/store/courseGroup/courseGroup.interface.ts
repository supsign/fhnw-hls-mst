import { IModel } from '../model.interface';

export interface ICourseGroup extends IModel {
    name: string;
    study_field_id?: number;
}
