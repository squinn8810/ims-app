import { Vendor } from '../vendor/vendor';
import { Item } from './item';

describe('Item', () => {
  it('should create an instance', () => {
    expect(new Item('item', 'item.com', new Vendor('vendor','vendor@email.com','1234567890','vendor.com'))).toBeTruthy();
  });
});
