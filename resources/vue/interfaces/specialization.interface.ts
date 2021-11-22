import {IModel} from "../store/model.interface";

export interface ISpecialization extends IModel {
    study_field_id: number;
    name: string;
}
