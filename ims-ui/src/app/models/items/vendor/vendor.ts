export class Vendor {
    public vendorName: string;
    public vendorEmail: string;
    public vendorPhone: string;
    public vendorURL: string;

    constructor(
        vendorName: string,
        vendorEmail: string,
        vendorPhone: string,
        vendorURL: string
    ) {
        this.vendorName = vendorName;
        this.vendorEmail = vendorEmail;
        this.vendorPhone = vendorPhone;
        this.vendorURL = vendorURL;
    }
}
