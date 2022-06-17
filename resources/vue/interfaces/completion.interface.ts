import { IModel } from '../store/model.interface';

export interface ICompletion extends IModel {
    course_id: number;
    completion_type_id: number;
}
