export class LoginRequest {
    public email: string;
    public password: string;
    public remember: boolean;
    constructor(
        email: string,
        password: string,
        remember: boolean,
      ) {  }
}
