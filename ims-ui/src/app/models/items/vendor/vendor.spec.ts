import { Vendor } from './vendor';

describe('Vendor', () => {
  it('should create an instance', () => {
    expect(new Vendor('vendor','vendor@email.com','1234567890','vendor.com')).toBeTruthy();
  });
});
