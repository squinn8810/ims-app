export class BaseError {
    public errors: string[];
    public message: string;

    constructor(
        errors: string[],
        message: string,
    ) {}
}
