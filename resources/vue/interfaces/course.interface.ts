import { IModel } from '../store/model.interface';
import { ICourseSkill } from './courseSkill.interface';

export interface ICourse extends IModel {
    course_type_id: number;
    credits: number;
    language_id: number;
    name?: string;
    number: string;
    study_field_id?: number;
    is_hs: boolean;
    is_fs: boolean;
    course_skills: ICourseSkill[];
    number_unformated: string;
}
