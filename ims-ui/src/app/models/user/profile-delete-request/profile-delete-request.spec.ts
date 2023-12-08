import { ProfileDeleteRequest } from './profile-delete-request';

describe('ProfileDeleteRequest', () => {
  it('should create an instance', () => {
    expect(new ProfileDeleteRequest('email@email.com', 'password')).toBeTruthy();
  });
});
