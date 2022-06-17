import axios, { AxiosError } from 'axios';
import Swal from 'sweetalert2';
import { IModel } from './model.interface';

export class BaseRequestModel {
    protected static modelRouteName: string;

    public static post<T extends Partial<IModel>>(entitiy: T): Promise<T> {
        return new Promise((resolve, reject) => {
            axios
                .post<T>(`/webapi/${this.modelRouteName}`, entitiy)
                .then((res) => {
                    resolve(res.data);
                })
                .catch((reason: AxiosError<{ message: string }>) => {
                    Swal.fire({
                        html: reason.response.data.message,
                        icon: 'error',
                    });
                    reject(reason.response.data.message);
                });
        });
    }

    public static delete(id: number): Promise<void> {
        return new Promise((resolve, reject) => {
            axios
                .delete<void>(`/webapi/${this.modelRouteName}/${id}`, {})
                .then((res) => {
                    resolve(res.data);
                })
                .catch((reason: AxiosError<{ message: string }>) => {
                    Swal.fire({
                        html: reason.response.data.message,
                        icon: 'error',
                    });
                    reject(reason.response.data.message);
                });
        });
    }

    public static getById<T extends IModel>(id: number): Promise<T> {
        return new Promise((resolve, reject) => {
            axios
                .get<T>(`/webapi/${this.modelRouteName}/${id}`)
                .then((res) => {
                    resolve(res.data);
                })
                .catch((reason: AxiosError<{ message: string }>) => {
                    Swal.fire({
                        html: reason.response.data.message,
                        icon: 'error',
                    });
                    reject(reason.response.data.message);
                });
        });
    }

    public static patch(entity: IModel): Promise<IModel> {
        return new Promise((resolve, reject) => {
            axios
                .patch<IModel>(`/webapi/${this.modelRouteName}/${entity.id}`, entity)
                .then((res) => {
                    resolve(res.data);
                })
                .catch((reason: AxiosError<{ message: string }>) => {
                    Swal.fire({
                        html: reason.response.data.message,
                        icon: 'error',
                    });
                    reject(reason.response.data.message);
                });
        });
    }
}
