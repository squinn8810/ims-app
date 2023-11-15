import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';

@Component({
  standalone: true,
  selector: 'app-login-layout',
  templateUrl: './login-layout.component.html',
  styleUrls: ['./login-layout.component.scss'],
  imports: [RouterOutlet, CommonModule, NgbModule]
})
export class LoginLayoutComponent {
  public accessToken: any;
  public accessTokenDetails: any;

  constructor() {}

}
