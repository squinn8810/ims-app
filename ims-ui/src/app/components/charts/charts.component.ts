import { Component, Input, Output, EventEmitter, OnInit } from '@angular/core';
import { NgIf } from '@angular/common';
import { ActivatedRoute, Router } from '@angular/router';
import { ScannerService } from 'src/app/services/scanner/scanner.service';

declare var google: any;

@Component({
    standalone: true,
    selector: 'app-chart',
    template: `
    <div>
    <!-- Show loading animation if loading is true -->
    <div *ngIf="loading" class="loading-animation">
    <div class="spinner"></div>
    </div>

    <!-- Show charts if loading is false -->
    <div *ngIf="!loading">
      <div id="table_div">
      </div>

      <div class="row">
        <div class="col-md-6">
          <div id="trend_div">
          </div>
        </div>
        <div class="col-md-6">
          <div id="pie_div" style="width: 100%; height: 500px;">
          </div>
        </div>
      </div>
    </div>
  </div>
  `,
    styleUrls: ['./charts.component.scss'],
    imports: [NgIf],
})

export class ChartComponent implements OnInit {
    data: any;
    google: any;
    @Input() recentTransactions: any;
    @Input() transactionDistribution: any;
    @Input() transactionTrends: any;
    @Output() chartReady = new EventEmitter<any>();
    loading: boolean = true;


    constructor(
        private scannerService: ScannerService,
    ) { }


    ngOnInit(): void {
        this.getDataView();

        setTimeout(() => {
            this.loading = false;
        }, 10000);

    }

    getDataView(): void {
        this.scannerService.getDataView().subscribe(
            (response) => {
                this.data = response;
                this.loading = false;
                // Draw charts
                this.drawTableChart();
                this.drawLineChart();
                this.drawPieChart();
            },
            (error) => {
                console.error('Error fetching data:', error);
            }
        );
    }

    private drawTableChart(): void {
        const jsonData: any[] = this.data.recentTransactions; // Declare the type explicitly
        google.charts.load('current', { packages: ['table'] });
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

    private drawLineChart(): void {
        const jsonData2 = this.data.transactionTrends;
        google.charts.load('current', { packages: ['corechart'] });
        google.charts.setOnLoadCallback(() => {
            const data = new google.visualization.DataTable();
            data.addColumn('string', 'Date');
            data.addColumn('number', 'Transactions');

            const keys = Object.keys(jsonData2);
            keys.forEach((key) => {
                const value = jsonData2[key];
                data.addRow([key, value]);
            });

            const options = {
                title: 'Usage Trends',
                width: 900,
                height: 600,
                hAxis: { gridlines: {} },
                vAxis: { gridlines: { count: 10 }, minValue: 0 },
            };

            const chart = new google.visualization.LineChart(document.getElementById('trend_div'));
            chart.draw(data, options);
        });
    }

    private drawPieChart(): void {
        const jsonData3 = this.data.transactionDistribution;
        google.charts.load('current', { packages: ['corechart'] });
        google.charts.setOnLoadCallback(() => {
            const data = new google.visualization.DataTable();
            data.addColumn('string', 'Item');
            data.addColumn('number', 'Reorders');

            const keys = Object.keys(jsonData3);

            keys.forEach((key) => {
                const value = jsonData3[key];
                data.addRow([key, value]);
            });

            const options = {
                title: 'Transaction Distributions',
                sliceVisibilityThreshold: 0.05,
            };

            const chart = new google.visualization.PieChart(document.getElementById('pie_div'));
            chart.draw(data, options);
        });
    }
}




