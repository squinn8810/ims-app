export class ProfileDeleteRequest {
    public affirmationText: string;
    public password: string;

    constructor(
        affirmationText: string,
        password: string,
      ) {
        this.affirmationText = affirmationText;
        this.password = password;
      }
}
