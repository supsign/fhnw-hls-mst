import { IModel } from '../model.interface';

export interface ICourseGroup extends IModel {
    import_id: string
    name: string
    study_field_id?: number
}
