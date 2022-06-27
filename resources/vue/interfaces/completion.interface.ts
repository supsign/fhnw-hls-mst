import { IModel } from '../store/model.interface';
import { ICourseYear } from './courseYear.interface';

export interface ICompletion extends IModel {
    completion_type_id: number;
    course_id: number;
    course_year: ICourseYear;
    course_year_id: number;
    credits: number;
    evento_id: number;
    student_id: number;
}
