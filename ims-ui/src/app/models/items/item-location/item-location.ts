import { Item } from "../item/item";

export class ItemLocation {
    public item: Item;
    public itemReorderQty: number;

    constructor(
        item: Item,
        itemReorderQty: number
    ) {
        this.item = item;
        this.itemReorderQty = itemReorderQty;
    }
}
