import { RegistrationRequest } from './registration-request';

describe('RegistrationRequest', () => {
  it('should create an instance', () => {
    expect(new RegistrationRequest('first', 'last', 'abc123', 'test@email.com', 'password', 'password')).toBeTruthy();
  });
});
