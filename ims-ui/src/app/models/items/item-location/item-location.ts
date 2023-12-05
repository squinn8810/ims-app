import { Item } from "../item/item";

export class ItemLocation {
    public item: Item;
    public itemReorderQty: number;
    public itemQty: number;
    public itemLocation: string;
    public message: string;

    constructor(
        item: Item,
        itemQty: number,
        itemReorderQty: number,
        itemLocation: string,
        message: string,
    ) {
        this.item = item;
        this.itemQty = itemQty;
        this.itemReorderQty = itemReorderQty;
        this.itemLocation = itemLocation;
        this.message = message;
    }
}