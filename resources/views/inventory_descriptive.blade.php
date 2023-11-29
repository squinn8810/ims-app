<html>
<h1>Descriptive Analytics for Reordering</h1>
<h2>
    Recent Transactions
</h2>

<head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var jsonData = @json($recentTransactions);
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
            keys.forEach(function(key) {
                data.addColumn(typeof jsonData[0][key], key);
            });

            // Add rows
            jsonData.forEach(function(item) {
                var row = [];
                keys.forEach(function(key) {
                    row.push(item[key]);
                });
                data.addRow(row);
            });


            var table = new google.visualization.Table(document.getElementById('table_div'));

            table.draw(data, {
                title: "Recent Transactions",
                showRowNumber: true,
                width: '100%',
                height: '100%'
            });



        }
    </script>
</head>

<body>
    <!--Div that will hold the  chart-->
    <div id="table_div"></div>
</body>

</html>

<html>
<h2>
    Transaction Trends
</h2>

<head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);
        var jsonData2 = @json($transactionTrends);

        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Date');
            data.addColumn('number', 'Transactions');

            var keys = Object.keys(jsonData2);

            keys.forEach(function(key) {
                var value = jsonData2[key];
                data.addRow([key, value]);
            });


            var options = {
                title: 'Usage Trends',
                width: '900',
                height: '600',
                hAxis: {
                    gridlines: {
                    }
                },
                vAxis: {
                    gridlines: {
                        count: 10
                    },
                    minValue: 0
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('trend_div'));

            chart.draw(data, options);


        }
    </script>
</head>

<body>
    <!--Div that will hold the  chart-->
    <div id="trend_div"></div>
</body>

</html>

<html>
<h2>
    Distribution of Transactions
</h2>

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);
        var jsonData3 = @json($transactionDistribution);


        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Item');
            data.addColumn('number', 'Reorders');

            var keys = Object.keys(jsonData3);

            keys.forEach(function(key) {
                var value = jsonData3[key];
                data.addRow([key, value]);
            });

            var options = {
                title: 'Transaction Distributions',
                sliceVisibilityThreshold: .05
            };

            var chart = new google.visualization.PieChart(document.getElementById('pie_div'));
            chart.draw(data, options);
        }
    </script>
</head>

<body>
    <!--Div that will hold the pie chart-->
    <div id="pie_div" style="width: 900px; height: 500px;"></div>
    </div>
</body>

</html>
