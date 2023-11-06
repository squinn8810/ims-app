import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { LoginService } from 'src/app/services/login/login.service';

@Component({
  standalone: true,
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent {
  
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

  logout(): void {
    this.loginService.logout()
      .subscribe(() => {
        localStorage.removeItem('access_token');
        this.router.navigate(['/login']);
      });
  }
}
