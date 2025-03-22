@extends('layouts.admin')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="tf-section-2 mb-30">
                <div class="flex gap20 flex-wrap-mobile">
                    <div class="w-half">
                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Total Orders</div>
                                        <h4>{{$totalOrderCount}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="rupee-icon" style="font-size: 28px">₹</i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Total Amount</div>
                                        <h4>{{$totalAmount}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Pending Orders</div>
                                        <h4>{{$pendingOrders}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="rupee-icon" style="font-size: 28px">₹</i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Pending Orders Amount</div>
                                        <h4>{{$pendingOrderAmount}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-half">
                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Delivered Orders</div>
                                        <h4>{{$deliveredOrders}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="rupee-icon" style="font-size: 28px">₹</i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Delivered Orders Amount</div>
                                        <h4>{{$deliveredOrderAmount}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Canceled Orders</div>
                                        <h4>{{$canceledOrders}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="rupee-icon" style="font-size: 28px">₹</i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Canceled Orders Amount</div>
                                        <h4>{{$canceledOrderAmount}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wg-box">
                    <div class="flex items-center justify-between">
                        <h5>Earnings revenue</h5>
                        {{-- <div class="dropdown default">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="icon-more"><i class="icon-more-horizontal"></i></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="javascript:void(0);">This Week</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Last Week</a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="flex flex-wrap gap40">
                        <div>
                            <div class="mb-2">
                                <div class="block-legend">
                                    <div class="dot t1"></div>
                                    <div class="text-tiny">Revenue</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h4>&#8377;{{$deliveredOrderAmount}}</h4>
                                {{-- <div class="box-icon-trending up">
                                    <i class="icon-trending-up"></i>
                                    <div class="body-title number">0.56%</div>
                                </div> --}}
                            </div>
                        </div>
                        <div>
                            <div class="mb-2">
                                <div class="block-legend">
                                    <div class="dot t2"></div>
                                    <div class="text-tiny">Order</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h4>&#8377;{{$totalAmount}}</h4>
                                {{-- <div class="box-icon-trending up">
                                    <i class="icon-trending-up"></i>
                                    <div class="body-title number">0.56%</div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div id="line-chart-8"></div>
                </div>
            </div>
            <div class="tf-section mb-30">
                <div class="wg-box">
                    <div class="flex items-center justify-between">
                        <h5>Recent orders</h5>
                        <div class="dropdown default">
                            <a class="btn btn-secondary dropdown-toggle" href="{{route('admin.orders')}}">
                                <span class="view-all">View all</span>
                            </a>
                        </div>
                    </div>
                    <div class="wg-table table-all-user">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 80px">Order No</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">Tax</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Transaction Status</th>
                                        <th class="text-center">Order Date</th>
                                        <th class="text-center">Total Items</th>
                                        <th class="text-center">Delivered On</th>
                                        <th class="text-center">View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1
                                    @endphp
                                    @foreach ($recentorders as $order)
                                    <tr>
                                        <td class="text-center">{{$i}}</td>
                                        <td class="text-center">{{$order->name}}</td>
                                        <td class="text-center">{{$order->phone}}</td>
                                        <td class="text-center">&#8377;{{$order->subtotal}}</td>
                                        <td class="text-center">&#8377;{{$order->tax}}</td>
                                        <td class="text-center">&#8377;{{$order->total}}</td>
                                        <td class="text-center">{{$order->status}}</td>
                                        <td class="text-center">@if ($order->transaction)
                                            {{$order->transaction->status}}
                                            @endif</td>
                                        <td class="text-center">{{$order->created_at}}</td>
                                        <td class="text-center">{{$order->orderItems->count()}}</td>
                                        <td class="text-center">{{$order->delivered_date}}</td>
                                        <td class="text-center">
                                            <form action="{{route('admin.order-detail')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$order->id}}">
                                                <a href="javascript:void(0)" onclick="this.closest('form').submit()">
                                                    <div class="list-icon-function view-icon">
                                                        <div class="item eye">
                                                            <i class="icon-eye"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                    $i++
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 SurfsideMedia</div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var tfLineChart = (function () {
        var chartBar = function (chartData) {
        var options = {
        series: [
        { name: 'Total', data: chartData.total },
        { name: 'Pending', data: chartData.pending },
        { name: 'Delivered', data: chartData.delivered },
        // { name: 'Canceled', data: chartData.canceled }
        ],
        chart: { type: 'bar', height: 325, toolbar: { show: false } },
        plotOptions: { bar: { horizontal: false, columnWidth: '10px', endingShape: 'rounded' } },
        dataLabels: { enabled: false },
        legend: { show: false },
        colors: ['#2377FC', '#FFA500', '#078407', '#FF0000'],
        xaxis: { categories: chartData.categories, labels: { style: { colors: '#212529' } } },
        yaxis: { show: false },
        fill: { opacity: 1 },
        tooltip: { y: { formatter: function (val) { return '&#8377;' + val.toFixed(2); } } }
        };

        var chart = new ApexCharts(document.querySelector("#line-chart-8"), options);
        chart.render();
        };

            return {
            load: function (chartData) {
            chartBar(chartData);
            },
            };
        })();

            fetch('/chart-data')
            .then(response => response.json())
            .then(data => {
            tfLineChart.load(data);
            })
            .catch(error => console.error('Error fetching chart data:', error));
        });
</script>
@endsection