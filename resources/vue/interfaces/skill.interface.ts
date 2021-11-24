import {IModel} from "../store/model.interface";
import {ICourse} from "./course.interface";


export interface ISkill extends IModel {
    definition: string
    taxonomy_id: number
    gain_course: ICourse
}
