import { LoginRequest } from './login-request';

describe('LoginRequest', () => {
  it('should create an instance', () => {
    expect(new LoginRequest('test@email.com','password',false)).toBeTruthy();
  });
});
