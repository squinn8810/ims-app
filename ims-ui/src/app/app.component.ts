import { CommonModule, NgIf, Location } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';
import { Component, OnInit, SimpleChanges } from '@angular/core';
import { ActivatedRoute, Router, RouterOutlet, UrlSegment } from '@angular/router';
import { LayoutComponent } from './components/layout/layout.component';
import { map } from 'rxjs';

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
  public noNavUrls: string[] = ['/login', '/register-user', '/forgot-password', '/reset-password'];
  public currentRoute: string;


  constructor(
    private location: Location,
  ) {}

  public ngOnInit(): void {
    this.checkRoute();
  }

  private checkRoute(): void {
    let urlMatches = false;

    this.noNavUrls.forEach(url => {
      if (this.location.path().includes(url)) {
        urlMatches = true;
      }
    });
    if (urlMatches) {
      this.showNav = false;
    }
    else {
      this.showNav = true;
    }
  }

}
