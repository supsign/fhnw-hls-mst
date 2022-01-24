import {IModel} from "../model.interface";


export interface IRecommendation extends IModel {
    name: string,
    study_field_id: number
}
