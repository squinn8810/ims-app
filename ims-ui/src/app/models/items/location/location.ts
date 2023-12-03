import { ItemLocation } from "../item-location/item-location";

export class Location {
    public locName: string;
    public locAddress: string;
    public locCity: string;
    public locState: string;
    public locZip: string;
    public itemLocations: ItemLocation[];
    
    constructor(
        locName: string,
        locAddress: string,
        locCity: string,
        locState: string,
        locZip: string,
        itemLocations: ItemLocation[],
    ) {
        this.locName = locName;
        this.locAddress = locAddress;
        this.locCity = locCity;
        this.locState = locState;
        this.locZip = locZip;
        this.itemLocations = itemLocations;
    }
}
