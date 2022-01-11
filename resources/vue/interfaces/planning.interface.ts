import {IModel} from "../store/model.interface"
import {ICourseRecommendation} from "./courseRecommendation.interface";
import {IAssessmentCourse} from "./assessmentCourse.interface";
import {ICourseSpecializationYear} from "./courseSpecializationYear.interface";
import {ICourseCrossQualificationYear} from "./courseCrossQualificationYear.interface";

export interface IPlanning extends IModel {
    cross_qualification_year_id: number
    mentor_id: number
    name: string
    specialization_year_id: number
    student_id: number
    study_field_year_id: number
    is_locked: boolean
    course_recommendations?: ICourseRecommendation[],
    assessment_courses?: IAssessmentCourse[],
    course_specialization_years?: ICourseSpecializationYear[],
    course_cross_qualification_years?: ICourseCrossQualificationYear[]
}
