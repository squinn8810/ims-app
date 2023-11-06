import { Component } from '@angular/core';
import { Router, RouterOutlet } from '@angular/router';
import { MatTabsModule } from '@angular/material/tabs';
import { MatButtonModule } from '@angular/material/button';
import { CommonModule } from '@angular/common';
import { LoginService } from 'src/app/services/login/login.service';

@Component({
  standalone: true,
  selector: 'app-layout',
  templateUrl: './layout.component.html',
  styleUrls: ['./layout.component.scss'],
  imports: [RouterOutlet, CommonModule, MatTabsModule, MatButtonModule]
})
export class LayoutComponent {
  public links = ['First', 'Second', 'Third'];
  public activeLink = this.links[0];

  public accessToken: any;
  public accessTokenDetails: any;

  constructor(
    private loginService: LoginService,
    private router: Router
  ) {
    this.accessToken = localStorage.getItem('access_token');
    this.accessTokenDetails = {
      id: '?',
      name: 'Test',
      email: 'test@email.com',
    };
  }

  public logout(): void {
    this.loginService.logout()
      .subscribe(() => {
        localStorage.removeItem('access_token');
        this.router.navigate(['/login']);
      });
  }
}
