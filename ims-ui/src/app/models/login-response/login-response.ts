export class LoginResponse {
    public authentication: string;
    
    constructor(
        authentication: string
    ) {
        this.authentication = authentication;
    }
}
