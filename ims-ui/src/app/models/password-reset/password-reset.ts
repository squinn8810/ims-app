export class PasswordReset {
    public token: string;
    public email: string;
    public password: string;
    public password_confirmation: string;

    constructor(
        token: string,
        email: string,
        password: string,
        password_confirmation: string,
    ) {}
}
