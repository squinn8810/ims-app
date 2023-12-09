import { ItemLocation } from './item-location';

describe('ItemLocation', () => {
  it('should create an instance', () => {
    expect(new ItemLocation('name', 5, 2,'vendor')).toBeTruthy();
  });
});
