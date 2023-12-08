export class User {
    public employee_id: number;
    public first_name: string;
    public last_name: string;
    public email: string;
    public isAdmin: boolean;

    constructor(
        employee_id: number,
        first_name: string,
        last_name: string,
        email: string,
        isAdmin: boolean,
    ) {
        this.employee_id = employee_id;
        this.first_name = first_name;
        this.last_name = last_name;
        this.email = email;
        this.isAdmin = isAdmin;
    }
}
