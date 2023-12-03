import { TransactionDate } from './transaction-date';

describe('TransactionDate', () => {
  it('should create an instance', () => {
    expect(new TransactionDate(new Date(),3,'America/NewYork')).toBeTruthy();
  });
});
