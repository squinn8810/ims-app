import { NgFor } from '@angular/common';
import { Component } from '@angular/core';
import { Organization } from 'src/app/models/items/organization/organization';

@Component({
  standalone: true,
  selector: 'app-inventory',
  templateUrl: './inventory.component.html',
  styleUrls: ['./inventory.component.scss'],
  imports: [NgFor]
})
export class InventoryComponent {
  public organizations: Organization[];

  constructor() {}
}
