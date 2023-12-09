import { UpdateUser } from './update-user';

describe('UpdateUser', () => {
  it('should create an instance', () => {
    expect(new UpdateUser('first', 'last', 'email@email.com', false)).toBeTruthy();
  });
});
