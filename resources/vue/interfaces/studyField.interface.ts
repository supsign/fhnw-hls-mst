import { IModel } from '../store/model.interface';

export interface IStudyField extends IModel {
    evento_id: number;
    evento_number: string;
    name: string;
    study_program_id: number;
}
