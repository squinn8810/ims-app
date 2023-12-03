import { PasswordReset } from './password-reset';

describe('PasswordReset', () => {
  it('should create an instance', () => {
    expect(new PasswordReset('token','email@email.com','password','password')).toBeTruthy();
  });
});
