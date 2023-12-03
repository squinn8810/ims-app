export class RegistrationRequest {
    constructor(
        public firstName: string,
        public lastName: string,
        public id: string,
        public email: string,
        public password: string,
        public currentPassword: string,
    ) {}
}
