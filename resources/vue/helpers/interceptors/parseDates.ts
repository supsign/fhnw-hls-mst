import { AxiosResponse } from "axios";
import { recMap } from "../recMap";

export const parseDates = (res: AxiosResponse<any>) => {
    recMap(res.data, (key, value) => {
        if (
            key.includes("date") ||
            key.includes("created_at") ||
            key.includes("updated_at") ||
            key === "time" ||
            key === "begin" ||
            key === "end_of_mutations"
        ) {
            if (typeof Date.parse(value) === "number") {
                return new Date(value);
            }
            return value;
        }
        return value;
    });
    return res;
};

export const parseDatesInModel = (model: { [key: string]: any }) => {
    recMap(model, (key, value) => {
        if (
            key.includes("date") ||
            key.includes("created_at") ||
            key.includes("updated_at") ||
            key === "time" ||
            key === "begin" ||
            key === "end_of_mutations"
        ) {
            if (typeof Date.parse(value) === "number") {
                return new Date(value);
            }
            return value;
        }
        return value;
    });
    return model;
};
