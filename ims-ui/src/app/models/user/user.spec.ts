import { User } from './user';

describe('User', () => {
  it('should create an instance', () => {
    expect(new User('123EID','first','last','email@email.com',true)).toBeTruthy();
  });
});
