import { ItemLocation } from '../item-location/item-location';
import { Item } from '../item/item';
import { Vendor } from '../vendor/vendor';
import { Location } from './location';

describe('Location', () => {
  it('should create an instance', () => {
    expect(new Location('locName','locAddress','locCity','Maine','01234',[new ItemLocation(new Item('item', 'item.com', new Vendor('vendor','vendor@email.com','1234567890','vendor.com')), 5)])).toBeTruthy();
  });
});
