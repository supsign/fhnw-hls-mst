import { courseSkillRequestModel } from './courseSkill.requestModel';
import { IBaseState } from '../base/baseState.interface';
import { ICourseSkill } from './courseSkill.interface';

export const requestModel = (): typeof courseSkillRequestModel => {
    return courseSkillRequestModel;
};

export const getByCoursesIds =
    (state: IBaseState<ICourseSkill>) =>
    (courseIds: number[]): ICourseSkill[] => {
        return state.entities.local.filter((courseSkill) => courseIds.includes(courseSkill.course_id));
    };
