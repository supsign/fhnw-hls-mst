import {IModel} from "../store/model.interface";

export interface IFaq extends IModel {
    question: string;
    answer: string;
    sort_order?: number;
}
