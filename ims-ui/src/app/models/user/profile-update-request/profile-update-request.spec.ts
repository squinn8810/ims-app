import { ProfileUpdateRequest } from './profile-update-request';

describe('ProfileUpdateRequest', () => {
  it('should create an instance', () => {
    expect(new ProfileUpdateRequest('first','last',123,'email@email.com')).toBeTruthy();
  });
});
