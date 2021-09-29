export interface IReason {
    response: {
        config: any;
        data: {
            errors?: { [key: string]: string[] };
            message: string;
        };
        headers: any;
        request: any;
        status: number;
        statusText: string;
    };
}
