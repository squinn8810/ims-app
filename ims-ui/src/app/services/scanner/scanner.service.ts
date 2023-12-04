import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
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
  //this should be moved to it's own service
  public getDataView(): Observable<any>{
    return this.http.get('api/reports', this.options);
  }

  getReportView(param1: string, param2: string): Observable<any> {
    // Construct the query parameters
    const params = new HttpParams()
      .set('itemLocID', param1)
      .set('time_period', param2);

    // Add the params to the request
    const options = { params };

    return this.http.get('api/reports', options);
  }
  
  public getScannedList(): Observable<any> {
    return this.http.get('/api/scanned-list', this.options);
  }

  public sendNotification(): Observable<any> {
    return this.http.post('/api/send-restock-notification', this.options);
  }



}
