import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, switchMap } from 'rxjs';
import { LoginRequest } from 'src/app/models/login-request';

@Injectable({
  providedIn: 'root'
})
export class LoginService {
private baseUrl = '//localhost:89';
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

login(loginRequest: LoginRequest): Observable<any> {
    return this.http
      .get(this.baseUrl + '/sanctum/csrf-cookie', this.options)
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

logout() {
  return this.http.post(this.baseUrl + '/api/logout', this.options);
}
}
