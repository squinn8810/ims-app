import { BaseError } from './base-error';

describe('BaseError', () => {
  it('should create an instance', () => {
    expect(new BaseError(['errors'],'message')).toBeTruthy();
  });
});
