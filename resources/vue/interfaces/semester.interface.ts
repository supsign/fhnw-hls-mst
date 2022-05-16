import {IModel} from "../store/model.interface"

export interface ISemester extends IModel {
    name: string
    is_hs: boolean
    previous_semester: ISemester
    previous_semester_id: number
    start_date: Date
    year: number
}
