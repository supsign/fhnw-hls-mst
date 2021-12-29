import {IModel} from "../store/model.interface";

export interface IAssessment extends IModel {
    name: string | null,
    amount_to_pass: number | null,
}
