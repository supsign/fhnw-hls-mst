import { IModel } from '../store/model.interface';

export interface ICourseCrossQualificationYear extends IModel {
    course_id: number;
    cross_qualification_year_id: number;
}
