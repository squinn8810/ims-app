import { NgFor, NgIf } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { GeneralError } from 'src/app/models/errors/general-error/general-error';
import { TransactionDate } from 'src/app/models/transaction-date/transaction-date';
import { Transaction } from 'src/app/models/transaction/transaction';
import { ScannerService } from 'src/app/services/scanner/scanner.service';

@Component({
  standalone: true,
  selector: 'app-notification',
  templateUrl: './notification.component.html',
  styleUrls: ['./notification.component.scss'],
  imports: [NgIf, NgFor],
})
export class NotificationComponent implements OnInit {
  public error: GeneralError;
  public transactions: Array<Transaction>;

  constructor(
    private scannerService: ScannerService,
  ) {}

  public ngOnInit(): void {
    this.getScannedList();
  }

  public getScannedList(): void {
    this.scannerService.getScannedList()
      .subscribe((scannedList: Transaction[]) => {
        this.transactions = scannedList;
      },
      (errorResponse: GeneralError) => {
        this.error = errorResponse;
      });
  }

  public sendNotification(): void {
    this.scannerService.sendNotification();
  }
}
