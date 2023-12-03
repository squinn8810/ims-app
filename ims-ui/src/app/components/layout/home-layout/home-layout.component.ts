import { Component } from '@angular/core';
import { Router, RouterOutlet } from '@angular/router';
import { CommonModule } from '@angular/common';
import { LoginService } from 'src/app/services/login/login.service';
import { NgbModule, NgbNavModule } from '@ng-bootstrap/ng-bootstrap';
import { GeneralError } from 'src/app/models/errors/general-error/general-error';

@Component({
  standalone: true,
  selector: 'app-layout',
  templateUrl: './home-layout.component.html',
  styleUrls: ['./home-layout.component.scss'],
  imports: [RouterOutlet, CommonModule, NgbModule, NgbNavModule]
})
export class HomeLayoutComponent {
  public error: GeneralError;

  public accessToken: any;
  public accessTokenDetails: any;

  constructor(
    private loginService: LoginService,
    private router: Router
  ) {
  }

  public logout(): void {
    this.loginService.logout()
      .subscribe(
        (data: any) => {
          localStorage.removeItem('auth-token');
          this.router.navigate(['/login']);
        },
        (errorResponse: GeneralError) => {
          this.error = errorResponse;
        }
      );
  }
}
