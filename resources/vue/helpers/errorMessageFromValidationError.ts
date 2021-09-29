import { IReason } from "../store/reason.interface";

export function errorMessageFromValidationError(reason: IReason): string {
    const response = reason.response;
    const messages: string[] = [];
    const errors: { [index: string]: string[] } = response.data.errors;
    // eslint-disable-next-line @typescript-eslint/no-unused-vars
    for (const [key, message] of Object.entries(errors)) {
        messages.push(...message);
    }

    return messages.join("<br>");
}
