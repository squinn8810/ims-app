import { NgFor, NgIf } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { InventoryService } from 'src/app/services/inventory/inventory.service';
import { GeneralError } from 'src/app/models/errors/general-error/general-error';
import { InventoryItem } from 'src/app/models/items/inventory-item/inventory-item';
import { map } from 'rxjs';

@Component({
  standalone: true,
  selector: 'app-inventory',
  templateUrl: './inventory.component.html',
  styleUrls: ['./inventory.component.scss'],
  imports: [ NgFor, NgIf ]
})
export class InventoryComponent implements OnInit {
  public inventoryItems: InventoryItem[];
  public error: GeneralError;
  public selectedLocation: string;

  constructor(
    private inventoryService: InventoryService
  ) {}

  public ngOnInit(): void {
    this.inventoryService.getInventoryItems()
    .pipe(map((response: any) => {
      this.inventoryItems = new Array<InventoryItem>;
      // Map object keys to location name variable
      Object.keys(response).forEach((key) => {
          this.inventoryItems.push(new InventoryItem(key, response[key]));
          });
      })
    )
    .subscribe();
  }

  public selectLocation(locationName: string) {
    if (this.selectedLocation !== locationName) {
      this.selectedLocation = locationName;
    } else {
      this.selectedLocation = '';
    }
  }

}
