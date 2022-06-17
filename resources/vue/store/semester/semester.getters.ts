import { semesterRequestModel } from './semester.requestModel';

export const requestModel = (): typeof semesterRequestModel => {
    return semesterRequestModel;
};
