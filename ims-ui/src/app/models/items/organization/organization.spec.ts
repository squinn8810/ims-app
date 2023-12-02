import { Organization } from './organization';

describe('Organization', () => {
  it('should create an instance', () => {
    expect(new Organization('name','address','city','Maine','01234','1234567890',new ItemLocation(new Item('item', 'item.com', new Vendor('vendor','vendor@email.com','1234567890','vendor.com')), 5))).toBeTruthy();
  });
});
