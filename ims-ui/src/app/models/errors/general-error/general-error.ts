import { BaseError } from "../base-error/base-error";

export class GeneralError {
    public error: BaseError;
    public status: number;
    public statusText: string;
    public name: string;
    public ok: boolean;
    public url: string;
    
    constructor(
        error: BaseError,
        status: number,
        statusText: string,
        name: string,
        ok: boolean,
        url: string
    ) {}
}
