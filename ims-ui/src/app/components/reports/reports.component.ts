import { Component, Input, Output, EventEmitter, OnInit } from '@angular/core';
import { NgFor, NgIf } from '@angular/common';
import { ActivatedRoute, Router } from '@angular/router';
import { ScannerService } from 'src/app/services/scanner/scanner.service';
import { FormsModule, NgModel } from '@angular/forms';
import { ChartComponent } from '../charts/charts.component';


declare var google: any;

@Component({
    standalone: true,
    selector: 'app-reports',
    templateUrl: './reports.component.html',
    styleUrls: ['./reports.component.scss'],
    imports: [NgIf, NgFor, FormsModule, ChartComponent],
})

export class ReportsComponent implements OnInit {
    data: any;
    google: any;
    @Output() chartReady = new EventEmitter<any>();
    loading: boolean = true;
    selectedTimePeriod: string = '';
    selectedItem: string = '';
    filterItems: any;

    constructor(
        private scannerService: ScannerService,
    ) { }


    ngOnInit(): void {

        this.getFilteredDataView(this.selectedTimePeriod, this.selectedItem);

        setTimeout(() => {
            this.loading = false;
        }, 20000);


    }

    getFilteredDataView(timePeriod: string, itemLocID: string): void {

        this.scannerService.getFilteredDataView2(timePeriod, itemLocID).subscribe(
            (response) => {
                this.data = response;
                this.filterItems = this.data.filterItems;
                this.loading = false;
                this.drawComboChart();
                if (this.selectedItem.trim() !== '') {
                    this.drawLineChart();
                }
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
        const lowSupply: { [index: string]: any } = this.data.lowSupplyData;
        const restock: { [index: string]: any } = this.data.restockData;
        const evalData: number[] = this.data.evalData;

        this.loading = false;

        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Date');
            data.addColumn('number', 'Low Supply Scans');
            data.addColumn('number', 'Resupply Scans');

            const keys = Object.keys(lowSupply);

            keys.forEach((key) => {
                var lowSupplyValue = lowSupply[key];
                var restockValue = restock[key];
                data.addRow([key, restockValue, lowSupplyValue]);//, evalData[1], evalData[0]]);

            });

            var options = {
                title: 'Low Supply vs Resupply',
                vAxis: {
                    title: 'Transactions'
                },
                series: {
                    0: {
                        type: 'bars'
                    }, 
                    1: {
                        type: 'bars'
                    },
                }
            };

            var chart = new google.visualization.ComboChart(document.getElementById('combo_chart'));
            chart.draw(data, options);
        }
    }

    private drawLineChart(): void {
        const trafficFlow = this.data.trafficFlow;
        const sumTrafficFlow = this.data.sumTrafficFlow;
        const suggestedQty = this.data.evalData[1];
        const currentQty = this.data.evalData[0];

        google.charts.load('current', { packages: ['corechart'] });


        google.charts.setOnLoadCallback(() => {
            const data = new google.visualization.DataTable();
            data.addColumn('string', 'Date');
            data.addColumn('number', 'Inventory Level');
            data.addColumn('number', 'Cumulative Invetory Level');
            data.addColumn('number', 'Current Reorder Quantity');
            data.addColumn('number', 'Suggested Reorder Quantity');

            const keys = Object.keys(trafficFlow);
            keys.forEach((key) => {
                const value = trafficFlow[key];
                data.addRow([key, value, sumTrafficFlow, currentQty, suggestedQty]);
            });

            const options = {
                title: 'Traffic Flow',
                width: '100%',
                height: '100%',
                hAxis: {
                    gridlines: {},
                    textPosition: 'none'
                }, vAxis: { gridlines: { count: 10 } },
                curveType: 'function',
                series: {
                    3: {  
                        lineDashStyle: [4, 4] 
                    }
                },
            };

            const chart = new google.visualization.LineChart(document.getElementById('traffic_div'));
            chart.draw(data, options);
        });
    }
}




