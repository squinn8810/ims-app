export class TransactionDate {
    public date: Date;
    public timezone_type: number;
    public timezone: string;

    constructor(
        date: Date,
        timezone_type: number,
        timezone: string
    ) {
        this.date = date;
        this.timezone_type = timezone_type;
        this.timezone = timezone;
    }
}
