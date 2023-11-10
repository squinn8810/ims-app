import { CommonModule, NgIf, Location } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';
import { Component, OnInit, SimpleChanges } from '@angular/core';
import { Router, RouterOutlet } from '@angular/router';
import { LayoutComponent } from './components/layout/layout.component';

@Component({
  standalone: true,
  selector: 'app-root',
  imports: [CommonModule, RouterOutlet, HttpClientModule, LayoutComponent, NgIf],
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {
  public title = 'Inventory Management System';
  public showNav: boolean;
  public noNavUrls: string[] = ['/login', '/register-user'];
  public currentRoute: string;


  constructor(
    private location: Location
  ) {}

  public ngOnInit(): void {
    this.checkRoute();
  }

  private checkRoute(): void {
    console.log('Location Path: ', this.location.path());
    if (false === this.noNavUrls.includes(this.location.path())) {
      this.showNav = true;
    }
    else {
      this.showNav = false;
    }
    console.log('Show Nav: ', this.showNav);
  }

}
