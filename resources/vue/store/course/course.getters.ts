import {courseRequestModel} from "./course.requestModel";
import {IBaseState} from "../base/baseState.interface";
import {ICourse} from "../../interfaces/course.interface";

export const requestModel = (): typeof courseRequestModel => {
    return courseRequestModel;
};

export const getByAcquisitionSkillIds = (state: IBaseState<ICourse>) =>
    (skillIds: number[]): ICourse[] => {
        const courses = state.entities.local.filter(
            entity => {
                return entity.course_skills.find(
                    courseSkill => {
                        return courseSkill.is_acquisition && skillIds.includes(courseSkill.skill_id)
                    })
            });

        return [...new Set(courses.map(item => item.id))].map(id => courses.find(course => course.id === id));
    };
