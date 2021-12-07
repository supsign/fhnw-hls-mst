import {IModel} from "../store/model.interface";

export interface ICourseSkill extends IModel {

    course_id: number,
    from_semester_id: number
    goal_number: number,
    is_acquisition: boolean
    skill_id: number
    to_semester_id: number
}
