import {IModel} from "../store/model.interface";

export interface IMentorStudent extends IModel {
    firstname: string
    lastname: string
    mentor_id: number
    student_id: number
}
