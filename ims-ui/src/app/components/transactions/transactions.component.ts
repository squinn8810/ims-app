import { Component, Input, Output, EventEmitter, OnInit } from '@angular/core';
import { NgIf } from '@angular/common';
import { ActivatedRoute, Router } from '@angular/router';
import { ScannerService } from 'src/app/services/scanner/scanner.service';
import { FormsModule } from '@angular/forms';


declare var google: any;

@Component({
    standalone: true,
    selector: 'app-transactions',
    templateUrl: './transactions.component.html',
    styleUrls: ['./transactions.component.scss'],
    imports: [NgIf, FormsModule],
})

export class TransactionComponent implements OnInit {
    data: any;
    google: any;
    //@Input() recentTransactions: any;
    //@Input() transactionDistribution: any;
    //@Input() transactionTrends: any;
    @Output() chartReady = new EventEmitter<any>();
    loading: boolean = true;
    selectedTimePeriod: string = '';


    constructor(
        private scannerService: ScannerService,
    ) { }


    ngOnInit(): void {
        this.getFilteredDataView(this.selectedTimePeriod);

        setTimeout(() => {
            this.loading = false;
        }, 10000);

    }

    getFilteredDataView(timePeriod: string): void {
        this.scannerService.getFilteredDataView1(timePeriod).subscribe(
            (response) => {
                this.data = response;
                this.loading = false;
                this.drawTableChart();
            },
            (error) => {
                console.error('Error fetching data:', error);
            }
        );
    }


    private drawTableChart(): void {
        const jsonData: any[] = this.data.recentTransactions; // Declare the type explicitly
        google.charts.load('current', { packages: ['table'] });
        
        this.loading = false;
        
        google.charts.setOnLoadCallback(() => {
            const data = new google.visualization.DataTable();
            const keys = Object.keys(jsonData[0]);

            keys.forEach((key) => {
                data.addColumn(typeof jsonData[0][key], key);
            });

            jsonData.forEach((item) => {
                const row = keys.map((key) => item[key]);
                data.addRow(row);
            });

            const options = {
                title: 'Recent Removals',
                showRowNumber: true,
                width: '100%',
                height: '100%',
            };

            const table = new google.visualization.Table(document.getElementById('table_div'));
            table.draw(data, options);
        });
    }
}




