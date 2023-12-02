import { Item } from '../item/item';
import { Vendor } from '../vendor/vendor';
import { ItemLocation } from './item-location';

describe('ItemLocation', () => {
  it('should create an instance', () => {
    expect(new ItemLocation(new Item('item', 'item.com', new Vendor('vendor','vendor@email.com','1234567890','vendor.com')), 5)).toBeTruthy();
  });
});
