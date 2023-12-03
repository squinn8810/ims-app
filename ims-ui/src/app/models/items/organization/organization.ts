import { Location } from "../location/location";

export class Organization {
    public name: string;
    public address: string;
    public city: string;
    public state: string;
    public zip: string;
    public phone: string;
    public location: Location;

    constructor(
        name: string,
        address: string,
        city: string,
        state: string,
        zip: string,
        phone: string,
        location: Location,
    ) {
        this.name = name;
        this.address = address;
        this.city = city;
        this.state = state;
        this.zip = zip;
        this.phone = phone;
        this.location = location;
    }
}
