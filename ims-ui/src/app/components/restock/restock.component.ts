import { NgFor, NgIf, } from '@angular/common';
import { Component, HostListener, OnInit } from '@angular/core';
import { Html5QrcodeResult, Html5QrcodeScanner } from 'html5-qrcode';
import { Html5QrcodeError } from 'html5-qrcode/esm/core';
import { GeneralError } from 'src/app/models/errors/general-error/general-error';
import { ScanResult } from 'src/app/models/scan-result/scan-result';
import { ItemLocation } from 'src/app/models/items/item-location/item-location';
import { ScannerService } from 'src/app/services/scanner/scanner.service';
import { Router } from '@angular/router';
import { FormControl, Validators, FormGroup, ReactiveFormsModule, FormBuilder } from '@angular/forms';
import { ScanForm } from 'src/app/models/scan-form/scan-form';

@Component({
  standalone: true,
  selector: 'app-restock',
  templateUrl: './restock.component.html',
  styleUrls: ['./restock.component.scss'],
  imports: [ReactiveFormsModule, NgIf, NgFor],
})

export class RestockComponent implements OnInit {
  public codeScanner: Html5QrcodeScanner;
  private qrBoxSize: number;
  public error: GeneralError;
  public scanSuccess: boolean;

  public notification: boolean;
  public scannerOpen: boolean;
  public itemLocation: { scannedList: ItemLocation[] } = { scannedList: [] };
  public scanForm: FormGroup;

  constructor(
    private scannerService: ScannerService,
    private router: Router,
    private formBuilder: FormBuilder,
  ) { }

  public ngOnInit(): void {
    this.notification = false;
    this.scannerOpen = false;
    this.getScannedList();
    this.openNewScanner();
    this.scanForm = this.formBuilder.group({
      itemQty: new FormControl('', [Validators.required, Validators.pattern('^[0-9]*$'),]),
    });
  }

  public onScanSuccess(decodedText: string, decodedResult: Html5QrcodeResult): void {
    console.log('Code matched = ' + decodedText + ', ' + decodedResult);

    let scanResult: ScanResult = new ScanResult(decodedText, false);

    this.scannerService.postScan(scanResult)
      .subscribe(
        (data: { scannedList: ItemLocation[] }) => {
          this.itemLocation = data;
          this.scanSuccess = true;
        },
        (errorResponse: GeneralError) => {
          this.error = errorResponse;
        }
      );

    this.codeScanner.clear();
    this.scannerOpen = false;
  }
  public onScanFailure(errorMessage: string, error: Html5QrcodeError): void {
    // handle scan failure
  }

  public getScannedList(): void {
    this.scannerService.getScannedList()
      .subscribe((data: { scannedList: ItemLocation[] }) => {
        this.itemLocation = data;
      });
  }

  public openNewScanner(): void {
    this.getScannerSize();
    this.createScanner();
  }

  private getScannerSize(): void {
    let minEdgeSize = Math.min(window.innerWidth, window.innerHeight);
    this.qrBoxSize = Math.floor(minEdgeSize * 0.7);
  }

  private createScanner(): void {
    if (!this.scannerOpen) {
      this.scanSuccess = false;
      this.codeScanner = new Html5QrcodeScanner(
        'qr-reader',
        { fps: 10, qrbox: { width: this.qrBoxSize, height: this.qrBoxSize } },
        /* verbose= */ false);
      this.codeScanner.render((text: string, result: Html5QrcodeResult) => this.onScanSuccess(text, result),
        (errorMessage: string, error: Html5QrcodeError) => this.onScanFailure(errorMessage, error));
      this.scannerOpen = true;
    }
  }

  public sendNotification(form: FormGroup): void {

    let scanForm: ScanForm = new ScanForm(form.get('itemQty')?.value);


    this.scannerService.sendRestockNotification(scanForm)
      .subscribe(
        (response) => {
          console.log('Notification sent successfully. Response:', response);
          this.notification = true;

          // Redirect to home after 3 seconds
          setTimeout(() => {
            this.router.navigate(['/home']);
          }, 1000);
        },
        (error) => {
          console.error('Error sending notification:', error);
        }
      );
  }



}

