import {courseRequestModel} from "./course.requestModel";
import {IBaseState} from "../base/baseState.interface";
import {ICourse} from "../../interfaces/course.interface";

export const requestModel = (): typeof courseRequestModel => {
    return courseRequestModel;
};

export const getByAcquisitionSkillId = (state: IBaseState<ICourse>) =>
    (skillId: number): ICourse => {
        return state.entities.local.find(entity => entity.course_skills.find(courseSkill => courseSkill.is_acquisition && courseSkill.skill_id === skillId));
    };
