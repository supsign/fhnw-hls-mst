import { ICourseCourseGroupYear } from "../store/courseCourseGroupYear/courseCourseGroupYear.interface";
import { ICourseGroup } from "../store/courseGroup/courseGroup.interface";
import { IModel } from "../store/model.interface";

export interface ICourseGroupYear extends IModel {
    amount_to_pass?: number;
    course_course_group_years: ICourseCourseGroupYear[];
    course_group: ICourseGroup;
    course_group_id: number;
    credits_to_pass?: number;
    study_field_year_id?: number;
}
