import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, switchMap } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class InventoryService {
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

  public getInventoryItems(): Observable<any> {
    return this.http.get('/sanctum/csrf-cookie', this.options)
      .pipe(
        switchMap(() =>
          this.http.get(
            '/api/inventory',
            this.options
          )
        )
      );
  }
}
