import { Component, OnInit } from '@angular/core';
import { NgIf } from '@angular/common';
import { ScannerService } from 'src/app/services/scanner/scanner.service';
import { FormsModule } from '@angular/forms';


declare var google: any;

@Component({
    standalone: true,
    selector: 'app-chart',
    templateUrl: './charts.component.html',
    styleUrls: ['./charts.component.scss'],
    imports: [NgIf, FormsModule],
})

export class ChartComponent implements OnInit {
    data: any;
    google: any;
    loading: boolean = true;
    selectedTimePeriod: string = '';


    constructor(
        private scannerService: ScannerService,
    ) { }


    ngOnInit(): void {
        this.getFilteredDataView(this.selectedTimePeriod);

        setTimeout(() => {
            this.loading = false;
        }, 20000);

    }

    getFilteredDataView(timePeriod: string): void {
        this.scannerService.getFilteredDataView1(timePeriod).subscribe(
            (response) => {
                this.data = response;
                this.loading = false;
                this.drawLineChart();
                this.drawPieChart();
            },
            (error) => {
                console.error('Error fetching data:', error);
            }
        );
    }

    onDropdownChange() {

        this.getFilteredDataView(this.selectedTimePeriod);
    }

    private drawLineChart(): void {
        const trendData = this.data.transactionTrends;
        google.charts.load('current', { packages: ['corechart'] });
        google.charts.setOnLoadCallback(() => {
            const data = new google.visualization.DataTable();
            data.addColumn('string', 'Date');
            data.addColumn('number', 'Transactions');

            const keys = Object.keys(trendData);
            keys.forEach((key) => {
                const value = trendData[key];
                data.addRow([key, value]);
            });

            const options = {
                title: 'Usage Trends',
                width: '100%',
                height: '100%',
                hAxis: { gridlines: {} },
                vAxis: { gridlines: { count: 10 }, minValue: 0 },
                curveType: 'function',
            };

            const chart = new google.visualization.LineChart(document.getElementById('trend_div'));
            chart.draw(data, options);
        });
    }

    private drawPieChart(): void {
        const pieData = this.data.transactionDistribution;
        google.charts.load('current', { packages: ['corechart'] });
        google.charts.setOnLoadCallback(() => {
            const data = new google.visualization.DataTable();
            data.addColumn('string', 'Item');
            data.addColumn('number', 'Reorders');

            const keys = Object.keys(pieData);

            keys.forEach((key) => {
                const value = pieData[key];
                data.addRow([key, value]);
            });

            const options = {
                title: 'Usage Distribution',
                width: '100%',
                height: '100%',
                sliceVisibilityThreshold: 0.05,
            };

            const chart = new google.visualization.PieChart(document.getElementById('pie_div'));
            chart.draw(data, options);
        });
    }
}




