export class UpdateUser {
    public firstName: string;
    public lastName: string;
    public email: string;
    public is_admin: boolean;
    private id: number;

    constructor(
        firstName: string,
        lastName: string,
        email: string,
        is_admin: boolean
    ) {
        this.firstName = firstName;
        this.lastName = lastName;
        this.email = email;
        this.is_admin = is_admin;
    }

    public setId(id: number): void {
        this.id = id;
    }
}
