@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('content')
    @if (isset($error))
        <div class="text-center px-4 py-80 rounded relative" role="alert">
            <h1
                class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-red-700 md:text-5xl lg:text-6xl dark:text-white">
                <strong class="font-bold items-center">Error </strong>
            </h1>
            <span class="block text-4xl text-red-700">{{ $error }}</span>
        </div>
    @else
        
        {{-- ตัวนับเวลาถอยหลัง --}}
        <div id="sticky-banner" tabindex="-1" class="fixed  start-1/2 z-50 flex justify-center py-4">
            <div class="flex items-center mx-auto">
                <span id="countdown" class="px-2 text-white bg-gray-400 rounded dark:bg-gray-500"></span>
            </div>
        </div>
        {{-- ตัวนับเวลาถอยหลัง --}}

        {{-- ตัว Chart --}}
        <div class="w-full h-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2  md:py-9 mt-4">

                @include('charts.donutchart')
                @include('charts.areachart')
            </div>
        </div>
        {{-- @dd($groupedData_format); --}}

        {{-- ตัว Chart --}}
    @endif
@endsection

@section('scripts')
    <script src="/resources/js/app.js"></script>
    <script src="/resources/js/charts_data.js"></script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            // Default date selection is today

            let donutSelectedDate = new Date();
            let areaSelectedDate = new Date();

            document.getElementById("donut-date-input").valueAsDate = donutSelectedDate;
            document.getElementById("area-date-input").valueAsDate = areaSelectedDate;

            // Initialize ApexCharts
            let donutChart = new ApexCharts(document.querySelector("#donut-chart"), getDonutChartOptions(
                donutSelectedDate));

            let areaChart = new ApexCharts(document.querySelector("#area-chart"), getAreaChartOptions(
                areaSelectedDate));


            areaChart.render();
            donutChart.render();

            // Function to load data based on selected date for area chart
            window.loadAreaData = function() {
                let selectedDate = new Date(document.getElementById("area-date-input").value);
                areaChart.updateOptions(getAreaChartOptions(selectedDate));
            };

            // Function to load data based on selected date for donut chart
            window.loadDonutData = function() {
                let selectedDate = new Date(document.getElementById("donut-date-input").value);
                donutChart.updateOptions(getDonutChartOptions(selectedDate));
            };

            // Function to reset data to current date for area chart
            window.resetAreaData = function() {
                let selectedDate = new Date();
                document.getElementById("area-date-input").valueAsDate = selectedDate;
                areaChart.updateOptions(getAreaChartOptions(selectedDate));
            };

            // Function to reset data to current date for donut chart
            window.resetDonutData = function() {
                let selectedDate = new Date();
                document.getElementById("donut-date-input").valueAsDate = selectedDate;
                donutChart.updateOptions(getDonutChartOptions(selectedDate));
            };

            // Function to reload data every 2 minutes with countdown timer
            let countdownInterval;

            function startCountdown() {
                let secondsLeft = 10;
                countdownInterval = setInterval(function() {
                    let minutes = Math.floor(secondsLeft / 60);
                    let seconds = secondsLeft % 60;
                    document.getElementById("countdown").textContent =
                        `ข้อมูลจะรีเฟรชในอีก ${minutes} นาที ${seconds} วินาที`;
                    secondsLeft--;
                    if (secondsLeft < 0) {
                        clearInterval(countdownInterval);
                        loadAreaData(); // Reload area chart data
                        loadDonutData(); // Reload donut chart data
                        startCountdown(); // Restart countdown
                    }
                }, 1000);
            }

            // Start countdown when page loads
            startCountdown();
        });

        // Function to get options for Area Chart based on selected date
        function getAreaChartOptions(selectedDate) {
            // Replace with actual data retrieval and processing based on selectedDate
            let dataSeries = generateRandomDataSeries(); // Replace with actual data
            let dataSeries1 = generateRandomDataSeries1();

            return {
                series: [{
                        name: "สาขา 1",
                        data: dataSeries
                    },
                    {
                        name: "สาขา 2",
                        data: dataSeries1
                    }
                ],
                chart: {

                    type: 'area',
                    height: 350,
                    sparkline: {
                        enabled: false
                    },
                    fontFamily: "Anuphan, sans-serif",
                    dropShadow: {
                        enabled: false,
                    },
                    toolbar: {
                        show: false,
                    },
                },
                xaxis: {
                    type: 'datetime',
                    categories: dataSeries.map(point => new Date(point.x).getTime()),
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Anuphan, sans-serif",
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        }
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false
                },
                yaxis: {
                    show: true,
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Anuphan, sans-serif",
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        },
                        formatter: function(value) {
                            return value.toLocaleString() + ' บาท';
                        }
                    }
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
            };
        }

        // Function to get options for Donut Chart based on selected date
        function getDonutChartOptions(selectedDate) {
            // Replace with actual data retrieval and processing based on selectedDate
            let dataSeries = generateRandomDataSeriesForDonut(); // Replace with actual data

            return {
                labels: [<?php echo $data['payment_desc']; ?>],
                // series: [<?php echo $data['total']; ?>],
                series: dataSeries,
                chart: {
                    height: 420,
                    width: "100%",
                    type: "donut",
                },
                stroke: {
                    colors: ["transparent"],
                    lineCap: "",
                },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontFamily: "Anuphan, sans-serif",
                                    offsetY: 20,
                                },
                                total: {
                                    showAlways: true,
                                    show: true,
                                    label: "Total",
                                    fontFamily: "Anuphan, sans-serif",
                                    formatter: function(w) {
                                        const sum = w.globals.seriesTotals.reduce((a, b) => {
                                            return a + b
                                        }, 0)
                                        return sum.toLocaleString() +
                                            " บาท" // ใช้ toLocaleString() เพื่อแสดงเลขที่มีลูกน้ำ
                                    },
                                },
                                value: {
                                    show: true,
                                    fontFamily: "Anuphan, sans-serif",
                                    offsetY: -20,
                                    formatter: function(value) {
                                        return value.toLocaleString() +
                                            " บาท" // ใช้ toLocaleString() เพื่อแสดงเลขที่มีลูกน้ำ
                                    },
                                }
                            },
                            size: "80%",
                        },
                    },
                },
                grid: {
                    padding: {
                        top: -2,
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    position: "bottom",
                    fontFamily: "Anuphan, sans-serif",
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return value.toLocaleString() + " บาท"
                        },
                    },
                },
                xaxis: {
                    labels: {
                        formatter: function(value) {
                            return value.toLocaleString() + " บาท"
                        },
                    },
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                },
            };
        }

        // Function to generate random data series (for demo purposes)
        function generateRandomDataSeries() {
            let series = [];
            let baseTime = new Date().getTime();
            for (let i = 0; i < 10; i++) {
                let time = baseTime - i * 86400000; // 1 day interval
                let value = Math.floor(Math.random() * 10000);
                series.push({
                    x: new Date(time),
                    y: value
                });
            }
            return series.reverse(); // Reverse to show in chronological order
        }

        function generateRandomDataSeries1() {
            let series = [];
            let baseTime = new Date().getTime();
            for (let i = 0; i < 10; i++) {
                let time = baseTime - i * 86400000; // 1 day interval
                let value = Math.floor(Math.random() * 9999);
                series.push({
                    x: new Date(time),
                    y: value
                });
            }
            return series.reverse(); // Reverse to show in chronological order
        }

        // Function to generate random data series for Donut Chart (for demo purposes)
        function generateRandomDataSeriesForDonut() {
            return [
                Math.floor(Math.random() * 10000),
                Math.floor(Math.random() * 10000),
                Math.floor(Math.random() * 10000)
            ];
        }
        
    </script>
@endsection
