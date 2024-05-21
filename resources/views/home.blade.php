@extends('layouts.admin')

@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-transparent card-block card-stretch card-height border-none">
                        <div class="card-body p-0 mt-lg-2 mt-0">
                            <h3 id="greeting" class="mb-3"></h3>
                            <p class="mb-0 mr-4">Your dashboard gives you views of key performance or business process.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4 card-total-sale">
                                        <div class="icon iq-icon-box-2 bg-info-light">
                                            <img src="../assets/images/product/1.png" class="img-fluid" alt="image">
                                        </div>
                                        <div>
                                            <p class="mb-2">Total Sales</p>
                                            <h4>{{ number_format($total, 2) }}{{ config('settings.currency_symbol') }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4 card-total-sale">
                                        <div class="icon iq-icon-box-2 bg-danger-light">
                                            <img src="../assets/images/product/3.png" class="img-fluid" alt="image">
                                        </div>
                                        <div>
                                            <p class="mb-2">Product Sold</p>
                                            <h4>{{ number_format($totalSellProduct) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Income Chart</h4>
                            </div>
                            <div class="card-header-toolbar d-flex align-items-center">
                                <div class="dropdown">
                                    <button class="dropdown-toggle dropdown-bg btn" type="button"
                                        id="timeframeDropdownButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Time Frame <i class="ri-arrow-down-s-line ml-1"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="timeframeDropdownButton">
                                        <a class="dropdown-item" href="#"
                                            onclick="changeTimeFrame('day', 'Day')">Day</a>
                                        <a class="dropdown-item" href="#"
                                            onclick="changeTimeFrame('month', 'Month')">Month</a>
                                        <a class="dropdown-item" href="#"
                                            onclick="changeTimeFrame('year', 'Year')">Year</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="price-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Purchaser Count Chart</h4>
                            </div>
                            <div class="card-header-toolbar d-flex align-items-center">
                                <div class="dropdown">
                                    <button class="dropdown-toggle dropdown-bg btn" type="button"
                                        id="timeframeDropdownButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Time Frame <i class="ri-arrow-down-s-line ml-1"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="timeframeDropdownButton">
                                        <a class="dropdown-item" href="#"
                                            onclick="changeTimeFrame('day', 'Day')">Day</a>
                                        <a class="dropdown-item" href="#"
                                            onclick="changeTimeFrame('month', 'Month')">Month</a>
                                        <a class="dropdown-item" href="#"
                                            onclick="changeTimeFrame('year', 'Year')">Year</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="order-count-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var currentTime = new Date().getHours();
        var greeting;

        if (currentTime >= 5 && currentTime < 12) {
            greeting = 'Good Morning';
        } else if (currentTime >= 12 && currentTime < 18) {
            greeting = 'Good Afternoon';
        } else if (currentTime >= 18 && currentTime < 21) {
            greeting = 'Good Evening';
        } else {
            greeting = 'Good Night';
        }

        document.getElementById('greeting').innerText = 'Hi {{ auth()->user()->name ?? 'Guest' }}, ' + greeting;

        function fetchChartData(timeframe) {
            fetch(`admin/fetch-chart-data/${timeframe}`)
                .then(response => response.json())
                .then(data => {
                    renderPriceChart(data.priceData);
                    renderOrderCountChart(data.orderCountData);
                });
        }

        function renderPriceChart(data) {
            var options = {
                series: [{
                    name: 'One Day Income',
                    data: data.map(item => item.total_price)
                }],
                chart: {
                    type: 'line',
                    height: 350,
                    background: '#f9f9f9',
                    foreColor: '#333',
                    fontFamily: 'Arial, sans-serif',
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800
                    }
                },
                colors: ['#FF5733'],
                xaxis: {
                    categories: data.map(item => item.day || item.month || item.year),
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    },
                    axisBorder: {
                        show: true,
                        color: '#ccc'
                    },
                    axisTicks: {
                        show: true,
                        color: '#ccc'
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'right',
                    offsetY: -10,
                    markers: {
                        width: 12,
                        height: 12,
                        radius: 5
                    },
                    fontFamily: 'Arial, sans-serif'
                },
                tooltip: {
                    theme: 'light',
                    x: {
                        formatter: function(val) {
                            return 'Day: ' + val;
                        }
                    },
                    style: {
                        fontSize: '12px'
                    }
                },
                grid: {
                    borderColor: '#ddd'
                }
            };

            var chart = new ApexCharts(document.querySelector("#price-chart"), options);
            chart.render();
        }

        function renderOrderCountChart(data) {
            var options = {
                series: [{
                    name: 'Purchaser',
                    data: data.map(item => item.order_count)
                }],
                chart: {
                    type: 'line',
                    height: 350
                },
                xaxis: {
                    categories: data.map(item => item.day || item.month || item.year)
                }
            };

            var chart = new ApexCharts(document.querySelector("#order-count-chart"), options);
            chart.render();
        }

        fetchChartData('month');

        function changeTimeFrame(timeframe) {
            fetchChartData(timeframe);
        }
    </script>
@endsection
