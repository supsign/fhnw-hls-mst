import {courseRequestModel} from "./course.requestModel";

export const requestModel = (): typeof courseRequestModel => {
    return courseRequestModel;
};
