import {IModel} from "../store/model.interface";
import {IMentorStudyField} from "./mentorStudyField.interface";

export interface IMentor extends IModel {
    firstname: string,
    lastname: string,
    mentor_study_fields?: IMentorStudyField[]
}
