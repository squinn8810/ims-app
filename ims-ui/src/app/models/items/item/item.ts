import { Vendor } from "../vendor/vendor";

export class Item {
    public itemName: string;
    public itemURL: string;
    public vendor: Vendor;

    constructor(
        itemName: string,
        itemURL: string,
        vendor: Vendor
    ) {
        this.itemName = itemName;
        this.itemURL = itemURL;
        this.vendor = vendor;
    }
}
