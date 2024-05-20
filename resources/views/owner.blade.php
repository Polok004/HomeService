@extends('loggedlayout')

@section('content')

<div class="section-title-01 honmob">
    <div class="bg_parallax image_02_parallax"></div>
    <div class="opacy_bg_02">
        <div class="container">
            <h1>Profile</h1>
            <div class="crumbs">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li>Profile</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="content-central">
    <div class="content_info">
        <div class="paddings-mini">
            <div class="container">
                <div class="row portfolioContainer">
                    <div class="col-md-8 col-md-offset-2 profile1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-6" style ="center">
                                        Company's Profile
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row" >
                                    <div class="col-md-4" >
                                        <img src="{{ asset('images/man-303792_1920.png') }}" width="100%">
                                    </div>    
                                    <div class="col-md-8" style="border-left: 5px dotted #ccc;">
                                        <h3><b>Name:</b>  Home Service</h3>
                                        <h3><b>Owner's Name:</b> Shoumik Barman Polok</h3>
                                        <h3><b>Email:</b> homeService@gmail.com</h3>
                                        <h3><b>Phone:</b> 01948405024</h3>
                                        <h3><b>Address:</b> Moutri Tower,Golpukur par,Mymensingh</h3>
                                    </div>
                                </div>
                                <div class="dotted-line"></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 40px; font-size: 18px;">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading" style="text-align: center;">
                                        My Customers
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h4><b>Total Customers:</b> {{ $totalCustomers }}</h4>
                                                <h4><b>Diamond Customers:</b> {{ $diamondCustomers }}</h4>
                                                <h4><b>Ruby Customers:</b> {{ $rubyCustomers }}</h4>
                                                <h4><b>Platinum Customers:</b> {{ $platinumCustomers }}</h4>
                                                <h4><b>Golden Customers:</b> {{ $goldenCustomers }}</h4>
                                                <h4><b>Silver Customers:</b> {{ $silverCustomers }}</h4>
                                            </div>
                                        </div>
                                        <div class="dotted-line"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading" style="text-align: center;">
                                        My Service & Service Providers
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h4><b>Service Providers:</b> {{ $totalServiceProviders }}</h4>
                                                <h4><b>Service Categories:</b> {{ $totalServiceCategories }}</h4>
                                                <h4><b>Service:</b> {{ $totalServices }}</h4>
                                                <h4><b>Salary(per month):</b> {{ $totalSalary }}</h4>
                                                <h4><b>Income:</b> {{ $totalIncome }}</h4>
                                            </div>
                                        </div>
                                        <div class="dotted-line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 40px; font-size: 18px;">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading" style="text-align: center;">
                                        Income vs Expense
                                    </div>
                                    <div class="panel-body">
                                        <canvas id="incomeExpenseChart"></canvas>
                                    </div>
                                    <div class="dotted-line"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading" style="text-align: center;">
                                        Piechart of service categories
                                    </div>
                                    <div class="panel-body">
                                        <canvas id="serviceCategoriesChart"></canvas>
                                    </div>
                                    <div class="dotted-line"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Script to render Income vs Expense Chart -->
<script>
    const incomeExpenseChartCanvas = document.getElementById('incomeExpenseChart').getContext('2d');
    const incomeExpenseChartData = {
        labels: ['Income', 'Expense'],
        datasets: [{
            label: 'Income vs Expense',
            data: [{{ $totalIncome }}, {{ $totalSalary }}], // Use the provided totalIncome and totalSalary
            backgroundColor: ['#36a2eb', '#ff6384']
        }]
    };
    const incomeExpenseChart = new Chart(incomeExpenseChartCanvas, {
        type: 'bar',
        data: incomeExpenseChartData,
        options: {
            legend: {
                labels: {
                    fontColor: 'yellow' // Change legend label color to yellow
                }
            }
        }
    });
</script>

<!-- Script to render Service Categories Pie Chart -->
<script>
    // Function to generate random color
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    // Generate random colors for each service category
    const serviceCategoriesColors = {!! json_encode(array_fill(0, count($serviceCategories), '#000000')) !!}; // Initialize with black colors
    for (let i = 0; i < serviceCategoriesColors.length; i++) {
        serviceCategoriesColors[i] = getRandomColor();
    }

    const serviceCategoriesChartCanvas = document.getElementById('serviceCategoriesChart').getContext('2d');
    const serviceCategoriesChartData = {
        labels: {!! json_encode($serviceCategories->pluck('name')) !!}, // Extract service category names
        datasets: [{
            data: {!! json_encode($serviceCategories->pluck('total_price')) !!}, // Extract total price for each category
            backgroundColor: serviceCategoriesColors
        }]
    };
    const serviceCategoriesChart = new Chart(serviceCategoriesChartCanvas, {
        type: 'pie',
        data: serviceCategoriesChartData
    });
</script>

@endsection
