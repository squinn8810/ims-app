import { TransactionDate } from "../transaction-date/transaction-date";

export class Transaction {
    public transDate: TransactionDate;
    public itemLocID: number;
    public employeeID: string;
    public transNum: number;

    constructor(
        transDate: TransactionDate,
        itemLocID: number,
        employeeID: string,
        transNum: number,
    ) {
        this.transDate = transDate;
        this.itemLocID = itemLocID;
        this.employeeID = employeeID;
        this.transNum = transNum;
    }
}
