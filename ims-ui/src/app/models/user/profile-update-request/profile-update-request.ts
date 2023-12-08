export class ProfileUpdateRequest {
    public firstName: string;
    public lastName: string;
    public email: string;
    public id: number;

    constructor(
        firstName: string,
        lastName: string,
        id: number,
        email: string,
    ) {
        this.firstName = firstName;
        this.lastName = lastName;
        this.email = email;
        this.id = id;
    }
}
