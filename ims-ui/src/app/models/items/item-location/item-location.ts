import { Item } from "../item/item";

export class ItemLocation {
    public itemName: string;
    public quantity: number;
    public reorder_quantity: number;
    public vendor: string;
    public message: string

    constructor(
        itemName: string,
        reorder_quantity: number,
        quantity: number,
        vendor: string,
        message: string,
    ) {
        this.itemName = itemName;
        this.reorder_quantity = reorder_quantity;
        this.quantity = quantity;
        this.vendor = vendor;
        this.message = message;
    }
}