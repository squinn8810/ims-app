import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, switchMap } from 'rxjs';
import { LoginRequest } from 'src/app/models/login-request/login-request';
import { RegistrationRequest } from 'src/app/models/registration-request/registration-request';

@Injectable({
  providedIn: 'root'
})
export class LoginService {
  private baseUrl = '';
  private options: any;

  constructor(
    private http: HttpClient
  ) {
    this.options = {
      headers: new HttpHeaders({
        Accept: 'application/json',
        'Content-Type': 'application/json',
      })
    };
  }

  public login(loginRequest: LoginRequest): Observable<any> {
    return this.http.get(this.baseUrl + '/sanctum/csrf-cookie', this.options)
      .pipe(
        switchMap(() =>
          this.http.post(
            this.baseUrl + '/api/login',
            loginRequest,
            this.options
          )
        )
      );
  }

  public logout() {
    return this.http.get(this.baseUrl + '/sanctum/csrf-cookie', this.options)
    .pipe(
      switchMap(() =>
        this.http.post(
          this.baseUrl + '/api/logout',
          this.options
        )
      )
    );
  }

  public register(registrationRequest: RegistrationRequest): Observable<any> {
    return this.http.get(this.baseUrl + '/sanctum/csrf-cookie', this.options)
      .pipe(
        switchMap(() =>
          this.http.post(
            this.baseUrl + '/api/register',
            registrationRequest,
            this.options
          )
        )
      );
  }

}
