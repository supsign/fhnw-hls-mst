import {IModel} from "../model.interface";

export interface ICourseSkill extends IModel {
    course_id: number,
    skill_id: number,
    is_acquisition: boolean,
}
