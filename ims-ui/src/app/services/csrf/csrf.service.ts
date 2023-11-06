import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class CsrfService {
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

  // public getCsrf(): string {
  //   return this.http.get(this.baseUrl + '/sanctum/csrf-cookie', this.options).pipe;
  // }
}
