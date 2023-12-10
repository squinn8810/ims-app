import { Component, OnInit } from '@angular/core';
import { NgbModule, NgbNavModule } from '@ng-bootstrap/ng-bootstrap';
import { Router } from '@angular/router';


@Component({
  standalone: true,
  selector: 'app-scan',
  templateUrl: './scanner.component.html',
  styleUrls: ['./scanner.component.scss'],
  imports: [NgbModule, NgbNavModule]
})

export class ScannerComponent implements OnInit {
  constructor(private router: Router) {}

  ngOnInit(): void {}

  navigateTo(route: string): void {
    this.router.navigate([`/${route}`]);
  }
}