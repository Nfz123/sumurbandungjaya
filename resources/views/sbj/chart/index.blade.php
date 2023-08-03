@extends('sbj.main')
@section('title', 'Laporan Harian')
@push('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Line Chart</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div class="chart">
                                <canvas id="lineChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Pie Chart</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="pieChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 659px;"
                                width="823" height="312" class="chartjs-render-monitor"></canvas>
                        </div>

                    </div>

                </div>


            </div>

        </div>
    </section>
    <script>
        // Access the passed data from the PHP variable
        var data = @json($data);

        // Function to generate a random hexadecimal color code
        function getRandomColor() {
            var letters = "0123456789ABCDEF";
            var color = "#";
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Extracting labels and data from the provided data
        var labels = data.map(item => item.namatype);
        var quantities = data.map(item => item.qty);

        // Generate random colors for the pie chart
        var backgroundColors = [];
        for (var i = 0; i < quantities.length; i++) {
            backgroundColors.push(getRandomColor());
        }

        // Define the pie chart data
        var pieChartData = {
            labels: labels,
            datasets: [{
                data: quantities,
                backgroundColor: backgroundColors
            }]
        };

        // Get the canvas element
        var ctx = document.getElementById('pieChart').getContext('2d');

        // Create the pie chart
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: pieChartData
        });
    </script>
    <script>
        // Sample data for demonstration purposes (replace this with your actual data)
        var data = @json($data);
        console.log('data');
        //  canvas element
        var ctx = document.getElementById('lineChart').getContext('2d');

        // Extracting labels and data from the provided data
        var labels = data.map(item => item.month);
        var uniqueNameTypes = [...new Set(data.map(item => item.namatype))];

        // Prepare datasets for each unique nametype
        var datasets = uniqueNameTypes.map(namatype => {
            var quantities = data.filter(item => item.namatype === namatype).map(item => item.qty);

            return {
                label: 'Quantity - ' + namatype,
                data: quantities,
                borderColor: getRandomColor(),
                fill: false,
            };
        });

        // Define the line chart data
        var lineChartData = {
            labels: labels,
            datasets: datasets,
        };

        // Create the line chart
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: lineChartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Quantity'
                        }
                    }
                }
            }
        });

        // Function to generate a random hexadecimal color code
        function getRandomColor() {
            var letters = "0123456789ABCDEF";
            var color = "#";
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>



    {{-- <script>
        // ... (Existing code)
    
        // Function to get month and year from a date string (YYYY-MM-DD format)
        function getMonthYearFromDate(dateString) {
            var date = new Date(dateString);
            var month = date.toLocaleString('default', { month: 'short' });
            var year = date.getFullYear();
            return month + ' ' + year;
        }
    
        // Preprocess data to group by months
        var monthlyData = {};
        data.forEach(item => {
            var monthYear = getMonthYearFromDate(item.created_at);
            if (!monthlyData[monthYear]) {
                monthlyData[monthYear] = {
                    totalQty: 0,
                    namatype: item.namatype // Save the namatype for each month
                };
            }
            monthlyData[monthYear].totalQty += item.qty;
        });
    
        // Extracting labels and data from the preprocessed data
        var labels = Object.keys(monthlyData);
        var quantities = Object.values(monthlyData).map(item => item.totalQty);
        var namatypes = Object.values(monthlyData).map(item => item.namatype);
    
        // Manually add labels for all months if not already present in the data
        var allMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        allMonths.forEach(month => {
            if (!labels.includes(month)) {
                labels.push(month);
                quantities.push(0); // Assuming no data for the month, set the quantity to 0
                namatypes.push(''); // Set an empty string for the nametype
            }
        });
    
        // ... (Remaining code)
    
    </script> --}}

@endsection
