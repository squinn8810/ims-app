import { TransactionDate } from "../transaction-date/transaction-date";

export class Transaction {
    public Id: number;
    public Date: string;
    public Item: string;
    public Location: string;
    public Status: string;
    public Employee: string;
    public Message: string;

    constructor(
        Id: number,
        Date: string,
        Item: string,
        Location: string,
        Status: string,
        Employee: string,
        Message: string,
    ) {
        this.Id = Id;
        this.Date = Date;
        this.Item = Item;
        this.Location = Location;
        this.Status = Status;
        this.Employee = Employee;
        this.Message = Message;
    }
}

