<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revenue Line Chart</title>
    <style>
        .body-chart {
            /* display: flex; */
            justify-content: center;
            align-items: center;
            height: 100%;
            /* Full height of the viewport */
            margin: 0;
            /* Remove default margin */
            background-color: #f8f9fa;
            /* Light background color */
        }

        #chartContainer {
            width: 90%;
            /* 90% of the screen width */
            width: 100%;
            /* Maximum width */
            height: 700px;
            /* Fixed height */
            margin: auto;
            /* Center the container */
        }

        canvas {
            width: 100% !important;
            /* Ensure canvas takes full width */
            height: 100% !important;
            /* Ensure canvas takes full height */
        }
    </style>
</head>

<body>
    <div class="body-chart">
        <h2 style="text-align: center;">Monthly Revenue</h2>
        <div id="chartContainer">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Revenue (VND)',
                    data: [5000000, 7000000, 8000000, 6000000, 9000000, 11000000, 12000000, 13000000, 9000000, 15000000, 16000000, 17000000], // Revenue data for each month
                    borderColor: 'blue',
                    backgroundColor: 'rgba(0, 0, 255, 0.2)',
                    borderWidth: 2,
                    fill: true // Fill color below the line chart
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Revenue (VND)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                }
            }
        });
    </script>
</body>

</html>