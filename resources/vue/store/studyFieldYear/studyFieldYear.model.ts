import {Store} from "vuex";
import {EntityModel} from "../base/baseEntity.model";
import {IBaseState} from "../base/baseState.interface";
import {StudyFieldYearRequestModel} from "./studyFieldYearRequestModel";
import {IStudyFieldYear} from "../../interfaces/studyFieldYear.interface";


export class StudyFieldYearModel extends EntityModel<IBaseState<IStudyFieldYear>,
    typeof StudyFieldYearRequestModel,
    IStudyFieldYear> {
    constructor(store: Store<IBaseState<IStudyFieldYear>>) {
        super("studyFieldYear", store, StudyFieldYearRequestModel);
    }
}
