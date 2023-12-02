import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, switchMap } from 'rxjs';
import { PasswordReset } from 'src/app/models/password-reset/password-reset';
import { ResetRequest } from 'src/app/models/reset-request/reset-request';

@Injectable({
  providedIn: 'root'
})
export class PasswordResetService {
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

  public sendResetRequest(forgotRequest: ResetRequest): Observable<any> {
    return this.http.get('/sanctum/csrf-cookie', this.options)
      .pipe(
        switchMap(() =>
          this.http.post(
            '/api/forgot-password',
            forgotRequest,
            this.options
          )
        )
      );
  }

  public resetPassword(passwordReset: PasswordReset): Observable<any> {
    return this.http.get('/sanctum/csrf-cookie', this.options)
      .pipe(
        switchMap(() =>
          this.http.post(
            '/api/reset-password',
            passwordReset,
            this.options
          )
        )
      );
  }
}
