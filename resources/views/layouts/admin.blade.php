<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>SurfsideMedia</title>
    <meta charset="utf-8">
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/animation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('admin/font/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('admin/icon/style.css')}}">
    <link rel="shortcut icon" href="{{asset('admin/images/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('admin/images/favicon.ico')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/sweetalert.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/custom.css')}}">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    @livewireStyles
</head>

<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">
                @include('website.adminsidebar')
                <div class="section-content-right">
                    @include('website.adminheader')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="{{asset('admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('admin/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('admin/js/apexcharts/apexcharts.js')}}"></script>
    <script src="{{asset('admin/js/main.js')}}"></script>
    {{-- <script>
        (function ($) {
    
                var tfLineChart = (function () {
    
                    var chartBar = function () {
    
                        var options = {
                            series: [{
                                name: 'Total',
                                data: [0.00, 0.00, 0.00, 0.00, 0.00, 273.22, 208.12, 0.00, 0.00, 0.00, 0.00, 0.00]
                            }, {
                                name: 'Pending',
                                data: [0.00, 0.00, 0.00, 0.00, 0.00, 273.22, 208.12, 0.00, 0.00, 0.00, 0.00, 0.00]
                            },
                            {
                                name: 'Delivered',
                                data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00]
                            }, {
                                name: 'Canceled',
                                data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00]
                            }],
                            chart: {
                                type: 'bar',
                                height: 325,
                                toolbar: {
                                    show: false,
                                },
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                    columnWidth: '10px',
                                    endingShape: 'rounded'
                                },
                            },
                            dataLabels: {
                                enabled: false
                            },
                            legend: {
                                show: false,
                            },
                            colors: ['#2377FC', '#FFA500', '#078407', '#FF0000'],
                            stroke: {
                                show: false,
                            },
                            xaxis: {
                                labels: {
                                    style: {
                                        colors: '#212529',
                                    },
                                },
                                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            },
                            yaxis: {
                                show: false,
                            },
                            fill: {
                                opacity: 1
                            },
                            tooltip: {
                                y: {
                                    formatter: function (val) {
                                        return "$ " + val + ""
                                    }
                                }
                            }
                        };
    
                        chart = new ApexCharts(
                            document.querySelector("#line-chart-8"),
                            options
                        );
                        if ($("#line-chart-8").length > 0) {
                            chart.render();
                        }
                    };
    
                    /* Function ============ */
                    return {
                        init: function () { },
    
                        load: function () {
                            chartBar();
                        },
                        resize: function () { },
                    };
                })();
    
                jQuery(document).ready(function () { });
    
                jQuery(window).on("load", function () {
                    tfLineChart.load();
                });
    
                jQuery(window).on("resize", function () { });
            })(jQuery);
    </script> --}}
    <script>
        $(function(){
                $(".delete").on('click',function(e){
                    e.preventDefault();
                    var selectedForm = $(this).closest('form');
                    swal({
                        title: "Are you sure?",
                        text: "You want to delete this record?",
                        type: "warning",
                        buttons: ["No!", "Yes!"],
                        confirmButtonColor: '#dc3545'
                    }).then(function (result) {
                        if (result) {
                            selectedForm.submit();  
                        }
                    });                             
                });
            });
    </script>
</body>

</html>