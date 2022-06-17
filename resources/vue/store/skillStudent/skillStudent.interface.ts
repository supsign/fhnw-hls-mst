import { IModel } from '../model.interface';

export interface ISkillStudent extends IModel {
    course_year_id: number;
    created_at: Date;
    skill_id: number;
    student_id: number;
    updated_at: Date;
}
