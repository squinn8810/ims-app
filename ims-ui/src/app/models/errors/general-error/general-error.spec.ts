import { BaseError } from '../base-error/base-error';
import { GeneralError } from './general-error';

describe('GeneralError', () => {
  it('should create an instance', () => {
    expect(new GeneralError(new BaseError(['errors'],'message'),400,'status','name',false,'error.com')).toBeTruthy();
  });
});
