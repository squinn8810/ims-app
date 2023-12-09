import { ItemLocation } from "../item-location/item-location";

export class InventoryItem {
    public locationName: string;
    public itemLocations: ItemLocation[];
  
    constructor(
        locationName: string,
        itemLocations: ItemLocation[],
    ) {
      this.locationName = locationName;
      this.itemLocations = itemLocations;
    }
}
