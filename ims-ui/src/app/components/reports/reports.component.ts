import { Component, Input, Output, EventEmitter, OnInit } from '@angular/core';
import { NgIf } from '@angular/common';
import { ActivatedRoute, Router } from '@angular/router';
import { ScannerService } from 'src/app/services/scanner/scanner.service';
import { FormsModule } from '@angular/forms';
import { ChartComponent } from '../charts/charts.component';


declare var google: any;

@Component({
    standalone: true,
    selector: 'app-reports',
    templateUrl: './reports.component.html',
    styleUrls: ['./reports.component.scss'],
    imports: [NgIf, FormsModule, ChartComponent],
})

export class ReportsComponent implements OnInit {
    data: any;
    google: any;
    @Output() chartReady = new EventEmitter<any>();
    loading: boolean = true;
    selectedTimePeriod: string = '';
    selectedItem: string = '';

    constructor(
        private scannerService: ScannerService,
    ) { }


    ngOnInit(): void {
        this.getFilteredDataView(this.selectedTimePeriod, this.selectedItem);

        setTimeout(() => {
            this.loading = false;
        }, 10000);

    }

    getFilteredDataView(timePeriod: string, itemLocID: string): void {
        this.scannerService.getFilteredDataView2(timePeriod, itemLocID).subscribe(
            (response) => {
                this.data = response;
                this.loading = false;
                // Draw charts
                this.drawComboChart();
                //this.drawLineChart();
                //this.drawPieChart();
            },
            (error) => {
                console.error('Error fetching data:', error);
            }
        );
    }

    onDropdownChange() {

        this.getFilteredDataView(this.selectedTimePeriod, this.selectedItem);
    }


    private drawComboChart(): void {
        const lowSupply: {[index: string]:any} = this.data.lowSupplyData;
        const restock: {[index: string]:any} = this.data.restockData;
        const evalData: number[] = this.data.evalData;

        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualization);


        function drawVisualization() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Date');
            data.addColumn('number', 'Low Supply Scans');
            data.addColumn('number', 'Resupply Scans');
            data.addColumn('number', 'Suggested Reorder Qty');
            data.addColumn('number', 'Item Reorder Qty');


            const keys = Object.keys(lowSupply);

            keys.forEach((key) => {
                var lowSupplyValue = lowSupply[key];
                var restockValue = restock[key];
                data.addRow([key, lowSupplyValue, restockValue, evalData[1], evalData[0]]);

            });

            var options = {
                title: 'Low Supply vs Resupply',
                vAxis: {
                    title: 'Transactions'
                },
                series: {
                    0: {
                        type: 'bars'
                    }, // 'Low Supply Alerts' as a bar chart
                    1: {
                        type: 'bars'
                    }, // 'Resupply Alerts' as a bar chart
                    2: {
                        type: 'line'
                    }, // 'Suggested Reorder Qty' as a line chart
                    3: {
                        type: 'line'
                    } // 'Item Reorder Qty' as a line chart
                }
            };

            var chart = new google.visualization.ComboChart(document.getElementById('combo_chart'));
            chart.draw(data, options);
        }
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
                width: '200%',
                height: '200%',
                hAxis: { gridlines: {} },
                vAxis: { gridlines: { count: 10 }, minValue: 0 },
                curveType: 'function',
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
                title: 'Usage Distribution',
                width: '200%',
                height: '200%',
                sliceVisibilityThreshold: 0.05,
            };

            const chart = new google.visualization.PieChart(document.getElementById('pie_div'));
            chart.draw(data, options);
        });
    }
}




