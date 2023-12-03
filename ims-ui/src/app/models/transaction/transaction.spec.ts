import { TransactionDate } from '../transaction-date/transaction-date';
import { Transaction } from './transaction';

describe('Transaction', () => {
  it('should create an instance', () => {
    expect(new Transaction(new TransactionDate(new Date(), 3, 'America/NewYork'),1,'employeeID',1)).toBeTruthy();
  });
});
