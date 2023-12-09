import { ItemLocation } from '../item-location/item-location';
import { InventoryItem } from './inventory-item';

describe('InventoryItem', () => {
  it('should create an instance', () => {
    expect(new InventoryItem('locationName', new ItemLocation('name', 5, 2,'vendor'))).toBeTruthy();
  });
});
