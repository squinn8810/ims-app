import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, switchMap } from 'rxjs';
import { ScanForm } from 'src/app/models/scan-form/scan-form';
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

  public getFilteredDataView1(param1: string): Observable<any> {
    let params = new HttpParams();
    if (param1.trim() !== '') {
      params = params.set('time_period', param1);
    }
    const options = { params };
    return this.http.get('api/reports', options);
  }

  public getFilteredDataView2(param1: string, param2: string): Observable<any> {
    let params = new HttpParams();
    if (param1.trim() !== '') {
      params = params.set('time_period', param1);
    }

    if (param2.trim() !== '') {
      params = params.set('itemLocID', param2);
    }
    const options = { params };
    return this.http.get('api/reports/insights', options);
  }

  
  public getScannedList(): Observable<any> {
    return this.http.get('/api/scanned-list', this.options);
  }


  public sendLowSupplyNotification(scanForm: ScanForm): Observable<any> {
    return this.http.get('/sanctum/csrf-cookie', this.options)
      .pipe(
        switchMap(() =>
          this.http.post(
            '/api/send-low-supply-notification',
            scanForm, // Assuming itemQty is a string; modify as needed
            this.options
          )
        )
      );
  }

  public sendRestockNotification(scanForm: ScanForm): Observable<any> {
    return this.http.get('/sanctum/csrf-cookie', this.options)
      .pipe(
        switchMap(() =>
          this.http.post(
            '/api/send-restock-notification',
            scanForm, // Assuming itemQty is a string; modify as needed
            this.options
          )
        )
      );
  }

}
