import {IModel} from "../store/model.interface";

export interface ICourseYear extends IModel {
    contents: string
    course_id: number
    created_at: string
    evento_id: number
    id: number
    is_audit: boolean
    name: string
    number: string
    semester_id: number
    updated_at: string
}
