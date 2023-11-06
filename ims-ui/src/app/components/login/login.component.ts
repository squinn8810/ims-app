import { Component } from '@angular/core';
import { NgIf } from '@angular/common';
import { LoginRequest } from 'src/app/models/login-request';
import { LoginService } from 'src/app/services/login/login.service';
import { FormsModule, ReactiveFormsModule, FormControl, Validators } from '@angular/forms';
import { MatInputModule } from '@angular/material/input';
import { MatCardModule } from '@angular/material/card';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatSidenavModule } from '@angular/material/sidenav';
import { MatButtonModule } from '@angular/material/button';
import { MatCheckboxModule } from '@angular/material/checkbox';
import { Router } from '@angular/router';
import { HttpClient, HttpClientXsrfModule, HttpHeaders } from '@angular/common/http';
import { Observable, switchMap } from 'rxjs';


@Component({
  standalone: true,
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
  imports: [FormsModule, HttpClientXsrfModule, MatCardModule, MatSidenavModule, MatFormFieldModule, 
    MatCheckboxModule, MatInputModule, MatButtonModule, ReactiveFormsModule, NgIf]
})
export class LoginComponent {
  public accessToken: any;
  public accessTokenDetails: any;
  private baseUrl = '';
  private options: any;

  constructor(
    private loginService: LoginService,
    private router: Router,
    private http: HttpClient,
  ) {
    this.accessToken = localStorage.getItem('access_token');
    this.accessTokenDetails = {
      id: '?',
      name: 'Test',
      email: 'test@email.com',
    };
    this.options = {
      headers: new HttpHeaders({
        Accept: 'application/json',
        'Content-Type': 'application/json',
      })
    };
  }

  private loginRequest: LoginRequest = new LoginRequest('','', false);
  
  public email = new FormControl('', [Validators.required, Validators.email]);
  public password = new FormControl('', [Validators.required]);
  public remember = new FormControl(false);

  public login(): void{
    this.loginRequest.email = this.email.value ? this.email.value : ''; 
    this.loginRequest.password = this.password.value ? this.password.value : '';
    this.loginRequest.remember = this.remember.value ? this.remember.value : false;
    console.log(this.loginRequest);
    
    this.http
        .get(this.baseUrl + '/sanctum/csrf-cookie', this.options)
        .pipe(
          switchMap(() =>
            this.http.post(
              this.baseUrl + '/api/login',
              this.loginRequest,
              this.options
            )
          )
        ).subscribe();
    
    // this.loginService.login(this.loginRequest)
    //   .subscribe((response: any) => {
    //     localStorage.setItem('access_token', response.access_token);
    //     this.router.navigate(['/']);
    //   }, (err: any) => {
    //     // this.errors = true;
    //   });
  }
}