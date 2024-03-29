<html>
<h2>Prescriptive Analytic
</h2>

<head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var jsonData = @json($frequentItems);
        google.charts.load('current', {
            'packages': ['table']
        });
        google.charts.setOnLoadCallback(drawTable);

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawTable);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawTable() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            // Assuming jsonData is an array of key-value pairs
            var keys = Object.keys(jsonData[0]);

            // Add columns
            data.addColumn('string', 'Item');
            data.addColumn('number', 'Times in Low Supply');
            // Add rows
            jsonData.forEach(function(itemData) {
                // Create a link for each item
                var link = '<a href="http://localhost/api/reports/insights?itemLocID=' + itemData.itemLocID + '">' +
                    itemData.Item + '</a>';

                // Add data to the row
                data.addRow([link, itemData.Transactions]);
            });


            var table = new google.visualization.Table(document.getElementById('sidebar'));

            table.draw(data, {
                title: "Fequently Ordered Items",
                showRowNumber: true,
                width: '100%',
                height: '100%',
                allowHtml: true // Enable HTML rendering in the table

            });

        }
    </script>
</head>

<body>
    <div id="sidebar">
    </div>
</body>

</html>

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualization);
        var lowSupply = @json($lowSupplyData);
        var restock = @json($restockData);
        var evalData = @json($evalData);

        function drawVisualization() {


            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Date');
            data.addColumn('number', 'Low Supply Alerts');
            data.addColumn('number', 'Restock Alerts');
            data.addColumn('number', 'Suggested Reorder Qty');
            data.addColumn('number', 'Item Reorder Qty');


            var keys = Object.keys(lowSupply);

            keys.forEach(function(key) {
                var lowSupplyValue = lowSupply[key];
                var restockValue = restock[key];
                data.addRow([key, lowSupplyValue, restockValue, evalData[1], evalData[0]]);

            });

            var options = {
                title: 'Cumulative Reorder Counts',
                vAxis: {
                    title: 'Transactions'
                },
                hAxis: {
                    title: 'Month'
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

            var chart = new google.visualization.ComboChart(document.getElementById('reorderCount_div'));
            chart.draw(data, options);
        }
    </script>
</head>

<body>
    <div id="reorderCount_div" style="width: 900px; height: 500px;"></div>
</body>

</html>



<style>
    #sidebar {
        position: fixed;
        top: 0;
        right: 0;
        width: 250px;
        height: 100%;
        background-color: #f2f2f2;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: auto;
        max-height: 600px;
    }
</style>
