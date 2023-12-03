import { NgFor, NgIf } from '@angular/common';
import { Component, HostListener, OnInit } from '@angular/core';
import { Html5QrcodeResult, Html5QrcodeScanner } from 'html5-qrcode';
import { Html5QrcodeError } from 'html5-qrcode/esm/core';
import { GeneralError } from 'src/app/models/errors/general-error/general-error';
import { ScanResult } from 'src/app/models/scan-result/scan-result';
import { Transaction } from 'src/app/models/transaction/transaction';
import { ScannerService } from 'src/app/services/scanner/scanner.service';

@Component({
  standalone: true,
  selector: 'app-scanner',
  templateUrl: './scanner.component.html',
  styleUrls: ['./scanner.component.scss'],
  imports: [NgIf, NgFor],
})
export class ScannerComponent implements OnInit {
  public codeScanner: Html5QrcodeScanner;
  private qrBoxSize: number;
  public error: GeneralError;
  public scanSuccess: boolean;
  public scannerOpen: boolean;
  public transactions: Transaction[];

  constructor(
    private scannerService: ScannerService,
  ) {}

  public ngOnInit(): void {
    this.getScannedList();
    this.scannerOpen = false;
    this.openNewScanner();
  }

  public onScanSuccess(decodedText: string, decodedResult: Html5QrcodeResult): void {
    // handle the scanned code as you like, for example:
    console.log('Code matched = ' + decodedText + ', ' + decodedResult);
    let scanResult: ScanResult = new ScanResult(decodedText, false);
    this.scannerService.postScan(scanResult)
        .subscribe(
          (scannedList: Transaction[]) => {
            this.transactions = scannedList;
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
      .subscribe((scannedList: Transaction[]) => {
        this.transactions = scannedList;
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
        { fps: 10, qrbox: {width: this.qrBoxSize, height: this.qrBoxSize} },
        /* verbose= */ false);
      this.codeScanner.render((text: string, result: Html5QrcodeResult) => this.onScanSuccess(text, result), 
        (errorMessage: string, error: Html5QrcodeError) => this.onScanFailure(errorMessage, error));
      this.scannerOpen = true;
    }
  }

}
