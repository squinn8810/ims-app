import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, switchMap } from 'rxjs';
import { ScanResult } from 'src/app/models/scan-result/scan-result';

@Injectable({
  providedIn: 'root'
})
export class ScannerService {
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

  public postScan(scanResult: ScanResult): Observable<any> {
    return this.http.get('/sanctum/csrf-cookie', this.options)
      .pipe(
        switchMap(() =>
          this.http.post(
            '/api/scan',
            scanResult,
            this.options
          )
        )
      );
  }

  public getScannedList(): Observable<any> {
    return this.http.get('/api/scanned-list', this.options);
  }

  public sendNotification(): Observable<any> {
    return this.http.post('/api/send-restock-notification', this.options);
  }
}
