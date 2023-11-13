import { ResetRequest } from './reset-request';

describe('ResetRequest', () => {
  it('should create an instance', () => {
    expect(new ResetRequest('email')).toBeTruthy();
  });
});
